<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['user_id',  'parent_id', 'name'];

    function items()
    {
        return $this->hasMany(Item::class, 'cat_id')->latest()->limit(18);
    }
    function subCats()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
