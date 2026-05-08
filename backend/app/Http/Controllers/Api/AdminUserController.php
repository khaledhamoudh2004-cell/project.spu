<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->with('pharmacies')
            ->orderBy('name')
            ->get();

        return response()->json(['users' => $users]);
    }

    public function store(Request $request)
    {
        if ($request->filled('phone')) {
            $request->merge(['phone' => $this->normalizePhone((string) $request->input('phone'))]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'required_without:phone', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30', 'required_without:email', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::in([
                User::ROLE_MANAGER,
                User::ROLE_PHARMACIST,
                User::ROLE_PATIENT,
                User::ROLE_GENERAL,
            ])],
            'pharmacy_ids' => ['nullable', 'array'],
            'pharmacy_ids.*' => ['integer', 'exists:pharmacies,id'],
        ]);

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        if (! empty($validated['pharmacy_ids'])) {
            $user->pharmacies()->sync($this->buildPharmacyPivot($validated['pharmacy_ids']));
        }

        return response()->json([
            'message' => 'User created successfully.',
            'user' => $user->load('pharmacies'),
        ], 201);
    }

    public function update(Request $request, User $user)
    {
        if ($request->filled('phone')) {
            $request->merge(['phone' => $this->normalizePhone((string) $request->input('phone'))]);
        }

        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['sometimes', 'nullable', 'string', 'max:30', Rule::unique('users', 'phone')->ignore($user->id)],
            'password' => ['sometimes', 'string', 'min:8'],
            'role' => ['sometimes', Rule::in([
                User::ROLE_MANAGER,
                User::ROLE_PHARMACIST,
                User::ROLE_PATIENT,
                User::ROLE_GENERAL,
            ])],
            'pharmacy_ids' => ['sometimes', 'array'],
            'pharmacy_ids.*' => ['integer', 'exists:pharmacies,id'],
        ]);

        if (array_key_exists('password', $validated)) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update(collect($validated)->except('pharmacy_ids')->toArray());

        if (array_key_exists('pharmacy_ids', $validated)) {
            $user->pharmacies()->sync($this->buildPharmacyPivot($validated['pharmacy_ids']));
        }

        return response()->json([
            'message' => 'User updated successfully.',
            'user' => $user->load('pharmacies'),
        ]);
    }

    public function destroy(Request $request, User $user)
    {
        if ((int) $request->user()->id === (int) $user->id) {
            return response()->json(['message' => 'You cannot delete your own account.'], 422);
        }

        $user->apiSessions()->update(['revoked_at' => now()]);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }

    private function buildPharmacyPivot(array $pharmacyIds): array
    {
        return collect($pharmacyIds)->mapWithKeys(
            fn ($id) => [(int) $id => ['role_in_pharmacy' => 'staff']]
        )->toArray();
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
}
