<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'credits'];
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
    public function majors(): BelongsToMany
    {
        return $this->belongsToMany(Major::class, 'major_subject', 'subject_id', 'major_id');
    }

}
