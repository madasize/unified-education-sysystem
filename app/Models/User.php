<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Grade;
use App\Models\TeachingResource;
use App\Models\InspectionReport;
use App\Models\ResourceAllocation;

#[Fillable(['name', 'email', 'password', 'role', 'school_id', 'verification_info'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function teachingResources()
    {
        return $this->hasMany(TeachingResource::class);
    }

    public function inspectionReports()
    {
        return $this->hasMany(InspectionReport::class, 'cluster_head_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function resourceAllocations()
    {
        return $this->hasMany(ResourceAllocation::class, 'cluster_head_id');
    }
}
