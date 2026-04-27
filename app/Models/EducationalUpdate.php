<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'ministry_user_id',
        'title',
        'content',
        'priority',
        'status',
        'published_at',
        'expires_at',
        'target_recipients',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'expires_at' => 'datetime',
            'target_recipients' => 'array',
        ];
    }

    public function ministry()
    {
        return $this->belongsTo(User::class, 'ministry_user_id');
    }
}
