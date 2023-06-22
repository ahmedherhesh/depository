<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'cat_id',
        'sub_cat_id',
        'company_id',
        'depot_id',
        'title',
        'notes',
        'file',
        'date',
        'price',
        'qty',
        'allowed_qty',
        'status'
    ];
    function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_cat_id');
    }
    function getFileAttribute($file)
    {
        return $this->attributes['file'] ? asset("uploads/files/$file") : null;
    }

    function setFileAttribute($file)
    {
        $file_name =  rand(1000, 9999) . time() . '.' . $file->extension();
        $file->move(public_path("uploads/files"), $file_name);
        $this->attributes['file'] = $file_name;
    }
    function scopeAllowed($query)
    {
        $user = session()->get('user');
        return $query->whereUserId($user->id)->orWhere('depot_id', $user->depot_id);
    }
    function scopeInStock($query){
        return $query->where('qty','>',0);
    }
}
