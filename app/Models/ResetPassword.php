<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResetPassword extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'token'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
