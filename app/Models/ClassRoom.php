<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassRoom extends Model
{
    protected $fillable = ['name', 'description', 'major_id'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }
}
