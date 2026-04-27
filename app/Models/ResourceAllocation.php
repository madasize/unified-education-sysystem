<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'cluster_head_id',
        'school_name',
        'resource_type',
        'quantity',
        'notes',
    ];

    public function clusterHead()
    {
        return $this->belongsTo(User::class, 'cluster_head_id');
    }
}
