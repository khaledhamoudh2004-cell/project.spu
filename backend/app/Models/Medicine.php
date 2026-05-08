<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'generic_name',
        'form',
        'strength',
        'description',
    ];

    public function pharmacies(): BelongsToMany
    {
        return $this->belongsToMany(Pharmacy::class)
            ->withPivot(['is_available', 'quantity', 'price', 'notes', 'updated_by'])
            ->withTimestamps();
    }
}
