<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements Translatable
{
    use HasFactory;
    use \Astrotomic\Translatable\Translatable;

    public $fillable = [
        'parent_id'
    ];

    public $translatedAttributes = ['title'];

    public function parent(){
        return $this->belongsTo(Category::class);
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent_id');
    }

//    public function translation(){
//        return $this->belongsToMany(Language::class, 'category_translations', 'item', 'language_code');
//    }

//    public function products(){
//        return $this->belongsToMany(Product::class, 'product_categories');
//    }
}
