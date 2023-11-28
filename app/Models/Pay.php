<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'order_id',
        'amount_from_buyer',
        'amount_to_seller',
        'amount_to_ht'
    ];
}
