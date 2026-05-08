<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = User::query()->updateOrCreate(
            ['email' => 'manager@pharm.local'],
            [
                'name' => 'System Manager',
                'phone' => '+963900000001',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_MANAGER,
            ]
        );

        $pharmacistA = User::query()->updateOrCreate(
            ['email' => 'pharmacist1@pharm.local'],
            [
                'name' => 'Ahmad Pharmacist',
                'phone' => '+963900000002',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_PHARMACIST,
            ]
        );

        $pharmacistB = User::query()->updateOrCreate(
            ['email' => 'pharmacist2@pharm.local'],
            [
                'name' => 'Nour Pharmacist',
                'phone' => '+963900000003',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_PHARMACIST,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'patient@pharm.local'],
            [
                'name' => 'Patient User',
                'phone' => '+963900000004',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_PATIENT,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'general@pharm.local'],
            [
                'name' => 'General User',
                'phone' => '+963900000005',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_GENERAL,
            ]
        );

        $pharmacyA = Pharmacy::query()->updateOrCreate(
            ['name' => 'Al-Shifa Pharmacy'],
            [
                'city' => 'Damascus',
                'address' => 'Abu Rummaneh Street',
                'phone' => '+963-11-123-4567',
                'is_active' => true,
                'extra_notes' => '24/7 service',
            ]
        );

        $pharmacyB = Pharmacy::query()->updateOrCreate(
            ['name' => 'Al-Hayat Pharmacy'],
            [
                'city' => 'Aleppo',
                'address' => 'Aziziyeh District',
                'phone' => '+963-21-765-4321',
                'is_active' => true,
                'extra_notes' => 'Home delivery supported',
            ]
        );

        $pharmacyA->pharmacists()->sync([
            $pharmacistA->id => ['role_in_pharmacy' => 'lead'],
            $pharmacistB->id => ['role_in_pharmacy' => 'staff'],
            $manager->id => ['role_in_pharmacy' => 'manager'],
        ]);

        $pharmacyB->pharmacists()->sync([
            $pharmacistB->id => ['role_in_pharmacy' => 'lead'],
        ]);

        $amoxicillin = Medicine::query()->updateOrCreate(
            ['name' => 'Amoxicillin'],
            [
                'generic_name' => 'Amoxicillin Trihydrate',
                'form' => 'Capsule',
                'strength' => '500mg',
                'description' => 'Antibiotic used for bacterial infections.',
            ]
        );

        $paracetamol = Medicine::query()->updateOrCreate(
            ['name' => 'Paracetamol'],
            [
                'generic_name' => 'Acetaminophen',
                'form' => 'Tablet',
                'strength' => '500mg',
                'description' => 'Pain and fever relief.',
            ]
        );

        $insulin = Medicine::query()->updateOrCreate(
            ['name' => 'Insulin Glargine'],
            [
                'generic_name' => 'Insulin',
                'form' => 'Injection',
                'strength' => '100 IU/ml',
                'description' => 'Long-acting insulin for diabetes control.',
            ]
        );

        $pharmacyA->medicines()->syncWithoutDetaching([
            $amoxicillin->id => [
                'is_available' => true,
                'quantity' => 85,
                'price' => 12.50,
                'notes' => 'Local supplier',
                'updated_by' => $pharmacistA->id,
            ],
            $paracetamol->id => [
                'is_available' => true,
                'quantity' => 210,
                'price' => 3.25,
                'notes' => 'Multiple brands',
                'updated_by' => $pharmacistA->id,
            ],
        ]);

        $pharmacyB->medicines()->syncWithoutDetaching([
            $paracetamol->id => [
                'is_available' => true,
                'quantity' => 140,
                'price' => 3.10,
                'notes' => 'Fast moving item',
                'updated_by' => $pharmacistB->id,
            ],
            $insulin->id => [
                'is_available' => true,
                'quantity' => 40,
                'price' => 28.90,
                'notes' => 'Stored refrigerated',
                'updated_by' => $pharmacistB->id,
            ],
        ]);
    }
}
