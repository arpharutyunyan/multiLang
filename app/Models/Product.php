<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $fillable = [
        'price'
    ];

    public function translation(){
        return $this->belongsToMany(Language::class, 'product_translations');
    }

    public function category(){
        return $this->belongsToMany(Category::class, 'product_categories');
    }
}
