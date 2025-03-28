<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $company_name
 * @property float $salary
 * @property boolean $is_remote
 * @property string $job_type
 * @property string $status
 * @property string|null $published_at
 */
class OurJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'company_name',
        'salary', 'is_remote',
        'job_type', 'status', 'published_at'
    ];

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'job_language');
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'job_city');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'job_category');
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class, 'our_job_id');
    }

    public function scopeFilter($query)
    {
        return $query->when(request('title'), fn($query, $title) => $query->where('title', 'LIKE', "%$title%"))
            ->when(request('description'), fn($query, $description) => $query->where('description', 'LIKE', "%$description%"))
            ->when(request('company_name'), fn($query, $companyName) => $query->where('company_name', 'LIKE', "%$companyName%"))
            ->when(!is_null(request('is_remote')), fn($query) => $query->where('is_remote', (int)request('is_remote')))
            ->when(request('job_type'), fn($query, $jobType) => $query->where('job_type', $jobType))
            ->when(request('status'), fn($query, $status) => $query->where('status', $status))
            ->when(request('min_salary') && request('max_salary'), fn($query) => $query->whereBetween('salary', [request('min_salary'), request('max_salary')]))
            ->when(request('published_at'), fn($query, $published_at) => $query->whereDate('published_at', $published_at));
    }
}

