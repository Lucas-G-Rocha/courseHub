<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'course_id', 'status', 'enrolled_at'];

    public function student()
    {
        $this->belongsTo(Student::class);
    }

    public function course()
    {
        $this->belongsTo(Course::class);
    }
}
