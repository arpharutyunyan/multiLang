<?php

namespace App\Models;


use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $fillable = [
        'price'
    ];

    public $translatedAttributes = ['title', 'description'];

    protected $translationForeignKey = 'item';

    public function category(){
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    // return array of all products with translatable fields
    public static function getItemsWithTranslation(){

        return self::withTranslation()
            ->translatedIn(app()->getLocale())
            ->get();
    }
}
