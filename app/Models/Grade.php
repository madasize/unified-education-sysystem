<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'student_id',
        'student_name',
        'subject',
        'score',
        'term',
        'is_synced',
    ];
    protected $casts = [
    'score' => 'float',
];

    /**
     * Relationship: A grade belongs to a Teacher (User).
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}