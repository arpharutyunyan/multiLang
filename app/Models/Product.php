<?php

namespace App\Models;


use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable, Sortable;

    public $fillable = [
        'price'
    ];

    // for sorting datatable
//    public $sortable = ['id', 'title', 'description', 'price', 'created_at', 'updated_at'];

    // attributes which will be translated
    public $translatedAttributes = ['title', 'description'];

    // laravel search in product_translations table foreign key with name 'product_id', but db table has column name 'item'
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
