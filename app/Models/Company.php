<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'country_code',
        'phone',
        'address',
        'logo',
        'website',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
