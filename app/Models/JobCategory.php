<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $our_job_id
 * @property int $category_id
 */
class JobCategory extends Model
{
    protected $table = 'job_category';
    protected $fillable = ['our_job_id', 'category_id'];
    public $timestamps = false;

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(OurJob::class, 'job_category');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'job_category');
    }
}
