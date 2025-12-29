<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_section_id',
        'title',
        'type',
        'video_url',
        'content',
        'duration_minutes',
        'is_free_preview',
        'order_index',
    ];

    public function section()
    {
        return $this->belongsTo(CourseSection::class, 'course_section_id');
    }
}
