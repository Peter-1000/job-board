<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $our_job_id
 * @property int $language_id
 */
class JobLanguage extends Model
{
    protected $table = 'job_language';
    protected $fillable = ['our_job_id', 'language_id'];
    public $timestamps = false;

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(OurJob::class, 'job_language');
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'job_language');
    }
}
