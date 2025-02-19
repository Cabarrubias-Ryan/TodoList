<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'id',
        'username',
        'password',
        'name',
        'email',
        'email_verified_at',
        'email_password',
        'account_id',
        'authentication_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
