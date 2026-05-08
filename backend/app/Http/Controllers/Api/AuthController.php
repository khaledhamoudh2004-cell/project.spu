<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'identifier' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'string'],
            'token_name' => ['nullable', 'string', 'max:120'],
        ]);

        $identifier = $validated['identifier']
            ?? $validated['email']
            ?? $validated['phone']
            ?? null;

        if (! $identifier) {
            throw ValidationException::withMessages([
                'identifier' => ['Email or phone is required.'],
            ]);
        }

        $user = $this->findUserByIdentifier($identifier);

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'identifier' => ['Invalid credentials.'],
            ]);
        }

        return response()->json(
            $this->issueToken(
                $user,
                $validated['token_name'] ?? 'web',
                $request
            )
        );
    }

    public function register(Request $request)
    {
        if ($request->filled('phone')) {
            $request->merge([
                'phone' => $this->normalizePhone((string) $request->input('phone')),
            ]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'required_without:phone', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30', 'required_without:email', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'token_name' => ['nullable', 'string', 'max:120'],
        ]);

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => User::ROLE_PATIENT,
        ]);

        return response()->json([
            ...$this->issueToken(
                $user,
                $validated['token_name'] ?? 'web',
                $request
            ),
            'message' => 'Account created successfully.',
        ], 201);
    }

    public function forgotPassword(Request $request)
    {
        $validated = $request->validate([
            'identifier' => ['required', 'string', 'max:255'],
        ]);

        $user = $this->findUserByIdentifier($validated['identifier']);

        $response = [
            'message' => 'If the account exists, a reset code has been sent.',
        ];

        if ($user) {
            $code = sprintf('%06d', random_int(0, 999999));
            Cache::put($this->passwordResetCacheKey((int) $user->id), Hash::make($code), now()->addMinutes(10));

            if (app()->environment('local')) {
                $response['debug_code'] = $code;
            }
        }

        return response()->json($response);
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'identifier' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'size:6'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $this->findUserByIdentifier($validated['identifier']);

        if (! $user) {
            throw ValidationException::withMessages([
                'identifier' => ['Account not found.'],
            ]);
        }

        $cacheKey = $this->passwordResetCacheKey((int) $user->id);
        $codeHash = Cache::get($cacheKey);

        if (! $codeHash || ! Hash::check($validated['code'], $codeHash)) {
            throw ValidationException::withMessages([
                'code' => ['Invalid or expired reset code.'],
            ]);
        }

        $user->update(['password' => Hash::make($validated['password'])]);
        $user->apiSessions()->whereNull('revoked_at')->update(['revoked_at' => now()]);
        Cache::forget($cacheKey);

        return response()->json([
            'message' => 'Password reset successful.',
        ]);
    }

    public function me(Request $request)
    {
        $user = $request->user()->load('pharmacies');

        return response()->json([
            'user' => $this->userPayload($user, withPharmacies: true),
        ]);
    }

    public function logout(Request $request)
    {
        $session = $request->attributes->get('apiSession');

        if ($session) {
            $session->update(['revoked_at' => now()]);
        }

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }

    private function userPayload(User $user, bool $withPharmacies = false): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'role' => $user->role,
            'pharmacies' => $withPharmacies ? $user->pharmacies->map(fn ($pharmacy) => [
                'id' => $pharmacy->id,
                'name' => $pharmacy->name,
                'city' => $pharmacy->city,
                'address' => $pharmacy->address,
                'phone' => $pharmacy->phone,
                'role_in_pharmacy' => $pharmacy->pivot->role_in_pharmacy,
            ])->values() : [],
        ];
    }

    private function issueToken(User $user, string $tokenName, Request $request): array
    {
        $plainToken = Str::random(80);

        ApiSession::query()->create([
            'user_id' => $user->id,
            'token_hash' => hash('sha256', $plainToken),
            'token_name' => $tokenName,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 1000),
            'last_used_at' => now(),
            'expires_at' => now()->addDays(30),
        ]);

        return [
            'token' => $plainToken,
            'user' => $this->userPayload($user),
        ];
    }

    private function findUserByIdentifier(string $identifier): ?User
    {
        $identifier = trim($identifier);

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return User::query()->where('email', $identifier)->first();
        }

        $normalizedPhone = $this->normalizePhone($identifier);

        return User::query()->where('phone', $normalizedPhone)->first();
    }

    private function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/\s+/', '', trim($phone)) ?? '';
        $phone = str_replace(['-', '(', ')'], '', $phone);

        if ($phone === '') {
            return '';
        }

        if (str_starts_with($phone, '00')) {
            return '+'.substr($phone, 2);
        }

        if (! str_starts_with($phone, '+')) {
            return '+'.$phone;
        }

        return $phone;
    }

    private function passwordResetCacheKey(int $userId): string
    {
        return "password_reset_code_{$userId}";
    }
}
