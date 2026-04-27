<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'cluster_head_id',
        'school_name',
        'findings',
        'inspected_at',
        'status',
    ];

    protected $casts = [
        'inspected_at' => 'date',
    ];

    public function clusterHead()
    {
        return $this->belongsTo(User::class, 'cluster_head_id');
    }
}
