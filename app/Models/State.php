<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property int $country_id
 */
class State extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'country_id'];

    /**
     * Get the country that owns the state.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get all cities for the state.
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function scopeFilter($query)
    {
        return $query->when(request('name'), fn($q, $name) => $q->where('states.name', 'like', "%$name%"))
            ->when(request('code'), fn($q, $code) => $q->where('states.code', 'like', "%$code%"))
            ->when(request('country_id'), fn($q, $countryId) => $q->where('states.country_id', $countryId));
    }
}

