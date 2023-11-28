<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdraw extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'total',
        'token',
        'status',
        'cccd',
        'phone',
        'bank',
        'stk',
        'cccd_front',
        'cccd_behind'
    ];

    public function user (): BelongsTo{
        return $this->belongsTo(User::class,'user_id','id');
    }
}
