<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'item_id',
        'recipient_name',
        'side_name',
        'notes',
        'status',
        'qty',
    ];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function itemReturn()
    {
        return $this->hasMany(ItemReturn::class);
    }
}
