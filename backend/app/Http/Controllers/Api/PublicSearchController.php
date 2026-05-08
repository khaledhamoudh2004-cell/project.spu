<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class PublicSearchController extends Controller
{
    public function search(Request $request)
    {
        $validated = $request->validate([
            'query' => ['required', 'string', 'min:2', 'max:100'],
            'city' => ['nullable', 'string', 'max:120'],
        ]);

        $term = trim($validated['query']);
        $city = $validated['city'] ?? null;

        $medicines = Medicine::query()
            ->where(function ($query) use ($term): void {
                $query->where('name', 'like', "%{$term}%")
                    ->orWhere('generic_name', 'like', "%{$term}%");
            })
            ->with(['pharmacies' => function ($query) use ($city): void {
                $query->where('is_active', true)
                    ->wherePivot('is_available', true)
                    ->when($city, fn ($q) => $q->where('city', 'like', "%{$city}%"))
                    ->orderBy('name');
            }])
            ->orderBy('name')
            ->limit(50)
            ->get()
            ->filter(fn (Medicine $medicine) => $medicine->pharmacies->isNotEmpty())
            ->values();

        $data = $medicines->map(fn (Medicine $medicine) => [
            'id' => $medicine->id,
            'name' => $medicine->name,
            'generic_name' => $medicine->generic_name,
            'form' => $medicine->form,
            'strength' => $medicine->strength,
            'available_in' => $medicine->pharmacies->map(fn ($pharmacy) => [
                'id' => $pharmacy->id,
                'name' => $pharmacy->name,
                'city' => $pharmacy->city,
                'address' => $pharmacy->address,
                'phone' => $pharmacy->phone,
                'quantity' => $pharmacy->pivot->quantity,
                'price' => $pharmacy->pivot->price,
                'notes' => $pharmacy->pivot->notes,
            ])->values(),
        ]);

        return response()->json([
            'total' => $data->count(),
            'medicines' => $data,
        ]);
    }

    public function showMedicine(Medicine $medicine)
    {
        $medicine->load(['pharmacies' => function ($query): void {
            $query->where('is_active', true)
                ->wherePivot('is_available', true)
                ->orderBy('name');
        }]);

        return response()->json([
            'medicine' => [
                'id' => $medicine->id,
                'name' => $medicine->name,
                'generic_name' => $medicine->generic_name,
                'form' => $medicine->form,
                'strength' => $medicine->strength,
                'description' => $medicine->description,
                'available_in' => $medicine->pharmacies->map(fn ($pharmacy) => [
                    'id' => $pharmacy->id,
                    'name' => $pharmacy->name,
                    'city' => $pharmacy->city,
                    'address' => $pharmacy->address,
                    'phone' => $pharmacy->phone,
                    'quantity' => $pharmacy->pivot->quantity,
                    'price' => $pharmacy->pivot->price,
                    'notes' => $pharmacy->pivot->notes,
                ])->values(),
            ],
        ]);
    }
}
