<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 */
class Language extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function jobs():BelongsToMany
    {
        return $this->belongsToMany(OurJob::class, 'job_language');
    }

    public function scopeFilter($query)
    {
        return $query->when(request('name'), fn ($query, $name) => $query->where('name', 'LIKE', "%$name%"));
    }

}
