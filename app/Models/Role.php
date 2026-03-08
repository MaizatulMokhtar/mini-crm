<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    public const SUPERADMIN = 1;
    public const COMPANY = 2;
    public const BRANCH = 3;
    public const EMPLOYEE = 4;
}
