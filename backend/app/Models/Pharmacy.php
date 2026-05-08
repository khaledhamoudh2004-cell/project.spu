<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'address',
        'phone',
        'is_active',
        'extra_notes',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function pharmacists(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role_in_pharmacy')
            ->withTimestamps();
    }

    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class)
            ->withPivot(['is_available', 'quantity', 'price', 'notes', 'updated_by'])
            ->withTimestamps();
    }
}
