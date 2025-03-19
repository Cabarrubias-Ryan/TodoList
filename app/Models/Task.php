<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'description',
        'is_complete',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
