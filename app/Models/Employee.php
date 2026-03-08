<?php

namespace App\Models;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'branch_id',
        'company_id',
        'full_name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'country_code',
        'phone',
        'position',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
