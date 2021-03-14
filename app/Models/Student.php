<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'age', 'entry_year', 'student_class_id'];

    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
