<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'public_id',
        'trading_name',
        'owner_name',
        'document',
        'coverage_area',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'coverage_area' => 'json',
        'address' => 'json',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'public_id';
    }

    /**
     * Scope to filter partners by address
     */
    public function scopeAddress(Builder $query, string $longitude, string $latitude): void
    {
        $coordinates = [(float) $longitude, (float) $latitude];
        $partners = $query->get();

        foreach ($partners as $partner) {
            if ($partner->address['coordinates'] == $coordinates) {
                $query->where('id', '=', $partner->id);
            }
        }
    }

    /**
     * Scope to filter partners by coverage area and proximity to a given location
     */
    public function scopeCoverageArea(Builder $query, string $longitude, string $latitude): void
    {

    }
}
