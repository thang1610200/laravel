<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellTicket extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'slug',
        'seller_id',
        'ticket_id',
        'commission_id',
        'price',
        'quantity',
        'sold',
        'isSell'
    ];

    public function seller (): BelongsTo{
        return $this->belongsTo(User::class,'seller_id','id');
    }

    public function ticket (): BelongsTo {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function commission (): BelongsTo{
        return $this->belongsTo(Commission::class,'commission_id','id');
    }

    public function order (): HasMany {
        return $this->hasMany(Order::class, 'ticket_id', 'id')->onlyTrashed();
    }

    public function orderAll (): HasMany {
        return $this->hasMany(Order::class, 'ticket_id', 'id')->withTrashed();
    }
}
