<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depository extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    function delivery()
    {
        $deliveries = $this->hasMany(Delivery::class,'depot_id');
        //between date and date
        if (request()->from && request()->to) {
            $deliveries->whereDate('created_at', '>=',  request()->from)
                ->whereDate('created_at', '<=',  request()->to);
        }
        //from date
        else if (request()->from && !request()->to)
            $deliveries->whereDate('created_at', '>=',  request()->from);
        //to date
        else if (!request()->from && request()->to)
            $deliveries->whereDate('created_at', '<=',  request()->to);
        return $deliveries = $deliveries->latest()->paginate(23);
    }
    function item()
    {
        $items = $this->hasMany(Item::class,'depot_id');
        //between date and date
        if (request()->from && request()->to) {
            $items->whereDate('created_at', '>=',  request()->from)
                ->whereDate('created_at', '<=',  request()->to);
        }
        //from date
        else if (request()->from && !request()->to)
            $items->whereDate('created_at', '>=',  request()->from);
        //to date
        else if (!request()->from && request()->to)
            $items->whereDate('created_at', '<=',  request()->to);
        return $items = $items->latest()->paginate(23);
    }
}
