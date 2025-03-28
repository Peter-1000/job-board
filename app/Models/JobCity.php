<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $our_job_id
 * @property int $city_id
 */
class JobCity extends Model
{
    protected $table = 'job_city';

    protected $fillable = ['our_job_id', 'city_id'];

    public $timestamps = false;

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(OurJob::class);
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class);
    }
}
