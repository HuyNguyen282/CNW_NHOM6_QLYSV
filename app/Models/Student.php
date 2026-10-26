<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_code','full_name','dob','gender','address','class_room_id',
    ];
    protected $casts = [
        'dob'=> 'date',
    ];
    public function classRoom(){
        return $this->belongsTo(ClassRoom::class);
    }
    public function scrores(){
        return $this->hasMany(Score::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
