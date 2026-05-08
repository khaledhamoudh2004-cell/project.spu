<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;

class PharmacistPharmacyController extends Controller
{
    public function myPharmacies(Request $request)
    {
        $pharmacies = $request->user()
            ->pharmacies()
            ->with('medicines')
            ->orderBy('name')
            ->get();

        return response()->json(['pharmacies' => $pharmacies]);
    }

    public function updatePharmacyInfo(Request $request, Pharmacy $pharmacy)
    {
        $this->ensureAssigned($request->user(), $pharmacy);

        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:120'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
            'extra_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $pharmacy->update($validated);

        return response()->json([
            'message' => 'Pharmacy information updated successfully.',
            'pharmacy' => $pharmacy->fresh(),
        ]);
    }

    public function upsertAvailability(Request $request, Pharmacy $pharmacy)
    {
        $this->ensureAssigned($request->user(), $pharmacy);

        $validated = $request->validate([
            'medicine_id' => ['nullable', 'integer', 'exists:medicines,id'],
            'name' => ['required_without:medicine_id', 'string', 'max:255'],
            'generic_name' => ['nullable', 'string', 'max:255'],
            'form' => ['nullable', 'string', 'max:80'],
            'strength' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_available' => ['required', 'boolean'],
            'quantity' => ['nullable', 'integer', 'min:0'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        $medicine = $this->resolveMedicine($validated);

        $pharmacy->medicines()->syncWithoutDetaching([
            $medicine->id => [
                'is_available' => $validated['is_available'],
                'quantity' => $validated['quantity'] ?? null,
                'price' => $validated['price'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'updated_by' => $request->user()->id,
                'updated_at' => now(),
            ],
        ]);

        return response()->json([
            'message' => 'Medicine availability updated successfully.',
            'medicine' => $medicine,
            'pharmacy' => $pharmacy->fresh()->load('medicines'),
        ]);
    }

    private function resolveMedicine(array $validated): Medicine
    {
        if (! empty($validated['medicine_id'])) {
            return Medicine::query()->findOrFail($validated['medicine_id']);
        }

        return Medicine::query()->firstOrCreate(
            [
                'name' => $validated['name'],
                'generic_name' => $validated['generic_name'] ?? null,
                'form' => $validated['form'] ?? null,
                'strength' => $validated['strength'] ?? null,
            ],
            [
                'description' => $validated['description'] ?? null,
            ]
        );
    }

    private function ensureAssigned(User $user, Pharmacy $pharmacy): void
    {
        $isAssigned = $user->pharmacies()
            ->where('pharmacies.id', $pharmacy->id)
            ->exists();

        abort_unless($isAssigned, 403, 'You are not linked to this pharmacy.');
    }
}
