<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobDetails extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_check',
        'category',
        'education',
        'gender',
        'interview_date',
        'job_description',
        'job_location',
        'job_title',
        'maxage',
        'minage',
        'minexp',
        'opening_number',
        'organizationname',
        'percentage',
        'physicalcheck',
        'position',
        'salary_range',
        'servicetirm',
        'url'
    ];

    protected $dates = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];

}
