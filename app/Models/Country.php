<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $code
 */
class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    /**
     * Get all states for the country.
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function scopeFilter($query)
    {
        return $query->when(request('name'), fn($q, $name) => $q->where('countries.name', 'like', "%$name%"))
            ->when(request('code'), fn($q, $code) => $q->where('countries.code', 'like', "%$code%"));
    }
}
