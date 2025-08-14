<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;

class Role extends Model
{
    use HasFactory, HasPermissions;
    protected $fillable = ['name', 'guard_name'];

    protected $casts = [
        'name' => 'string',
        'guard_name' => 'string',
        'permissions' => 'array',
    ];

    
}
