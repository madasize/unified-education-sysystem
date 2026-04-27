<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['name', 'logo_path', 'address', 'region', 'district', 'school_type', 'gender', 'ownership', 'source'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
