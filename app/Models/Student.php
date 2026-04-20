<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'form',
        'stream',
        'student_id',
    ];

    /**
     * Relationship: A student has many grade records.
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}