<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $fillable = [
        'parent_id'
    ];

    public function parent(){
        return $this->belongsTo(Category::class);
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function translation(){
        return $this->belongsToMany(Language::class, 'product_translations');
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'product_categories');
    }
}
