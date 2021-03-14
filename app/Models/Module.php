<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'start_date', 'end_date', 'teacher_id', 'student_class_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class);
    }
}
