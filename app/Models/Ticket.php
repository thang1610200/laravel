<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'quantity',
        'image',
        'seller_id',
        'isBrowse'
    ];

    public function commission(): BelongsTo {
        return $this->belongsTo(Commission::class);
    }

    public function seller(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function sellticket(): HasMany {
        return $this->hasMany(SellTicket::class,'ticket_id','id');
    }
}
