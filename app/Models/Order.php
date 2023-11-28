<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'token',
        'ticket_id',
        'buy_id',
        'quantity',
        'quantity_sell',
        'total',
        'deleted_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class,'buyer_id','id');
    }

    public function sellticket(): BelongsTo{
        return $this->belongsTo(SellTicket::class,'ticket_id','id');
    }

    public function pay(): HasOne {
        return $this->hasOne(Pay::class,'order_id','id');
    }
}
