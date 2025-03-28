<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property int $state_id
 */
class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'state_id'];

    /**
     * Get the state that owns the city.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(OurJob::class, 'job_language');
    }

    public function scopeFilter($query)
    {
        return $query->when(request('name'), fn($q, $name) => $q->where('cities.name', 'like', "%$name%"))
            ->when(request('state_id'), fn($q, $stateId) => $q->where('code', $stateId));
    }
}

