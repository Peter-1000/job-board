<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $our_job_id
 * @property string $value
 * @property string $type
 */
class Attribute extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attributes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'our_job_id',
        'value',
        'type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'our_job_id' => 'integer',
        'value' => 'string',
        'type' => 'string',
    ];

    /**
     * Get the job that owns the attribute.
     */
    public function job()
    {
        return $this->belongsTo(OurJob::class, 'our_job_id');
    }
}
