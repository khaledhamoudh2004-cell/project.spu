<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::query()
            ->with('pharmacists')
            ->orderBy('name')
            ->get();

        return response()->json(['pharmacies' => $pharmacies]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:120'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
            'extra_notes' => ['nullable', 'string', 'max:1000'],
            'pharmacist_ids' => ['nullable', 'array'],
            'pharmacist_ids.*' => ['integer', 'exists:users,id'],
        ]);

        $pharmacy = Pharmacy::query()->create(collect($validated)->except('pharmacist_ids')->toArray());

        if (array_key_exists('pharmacist_ids', $validated)) {
            $pharmacy->pharmacists()->sync($this->syncDataForPharmacists($validated['pharmacist_ids']));
        }

        return response()->json([
            'message' => 'Pharmacy created successfully.',
            'pharmacy' => $pharmacy->load('pharmacists'),
        ], 201);
    }

    public function update(Request $request, Pharmacy $pharmacy)
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:120'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
            'extra_notes' => ['nullable', 'string', 'max:1000'],
            'pharmacist_ids' => ['sometimes', 'array'],
            'pharmacist_ids.*' => ['integer', Rule::exists('users', 'id')],
        ]);

        $pharmacy->update(collect($validated)->except('pharmacist_ids')->toArray());

        if (array_key_exists('pharmacist_ids', $validated)) {
            $pharmacy->pharmacists()->sync($this->syncDataForPharmacists($validated['pharmacist_ids']));
        }

        return response()->json([
            'message' => 'Pharmacy updated successfully.',
            'pharmacy' => $pharmacy->load('pharmacists'),
        ]);
    }

    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();

        return response()->json(['message' => 'Pharmacy deleted successfully.']);
    }

    public function syncPharmacists(Request $request, Pharmacy $pharmacy)
    {
        $validated = $request->validate([
            'pharmacist_ids' => ['required', 'array'],
            'pharmacist_ids.*' => ['integer', 'exists:users,id'],
        ]);

        $pharmacy->pharmacists()->sync($this->syncDataForPharmacists($validated['pharmacist_ids']));

        return response()->json([
            'message' => 'Pharmacists linked successfully.',
            'pharmacy' => $pharmacy->load('pharmacists'),
        ]);
    }

    private function syncDataForPharmacists(array $ids): array
    {
        $pharmacistIds = User::query()
            ->whereIn('id', $ids)
            ->where('role', User::ROLE_PHARMACIST)
            ->pluck('id');

        return $pharmacistIds->mapWithKeys(
            fn ($id) => [(int) $id => ['role_in_pharmacy' => 'pharmacist']]
        )->toArray();
    }
}
