<?php

namespace App\Models;


use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable, Sortable;

    public $fillable = [
        'price',
        'screen_size',
        'ram',
        'memory',
        'main_camera',
        'front_camera',
        'battery_capacity',
        'os',
        'manufacturer_id'
    ];

    // for sorting datatable
    public static $sortable = ['id', 'price', 'created_at', 'updated_at'];

    // attributes which will be translated
    public $translatedAttributes = ['title', 'description'];

    // laravel search in product_translations table foreign key with name 'product_id', but db table has column name 'item'
    protected $translationForeignKey = 'item';

    public function category(){
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function product_translations(){
        return $this->hasOne(ProductTranslation::class, 'item');
    }

    // return array of all products with translatable fields
    public static function getItemsWithTranslation(){

        return self::withTranslation()
            ->translatedIn(app()->getLocale())
            ->get();
    }

    public static function getItemsByOrdered($query)
    {
        if(isset($query['sort'])){
            $attribute = $query['sort'];
            $sort_order = 'ASC';

            if(strncmp($attribute, '-', 1) === 0){
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }

            return self::select(['products.*', 'pt.title as title', 'pt.description as description'])
                ->join('product_translations as pt', 'products.id', '=', 'pt.item')
                ->where('pt.locale', app()->getLocale())
                ->orderby($attribute, $sort_order)
                ->get();

        }else{

            return self::withTranslation()
                ->translatedIn(app()->getLocale())
                ->get();
        }
    }

    public static function sortWithLaravelSortable($query){

        if(isset($query['sort'])){
            // if column is not translatable, will be in this model and could not including in this static array
            // that's why it must be translated
            if(!in_array($query['sort'], self::$sortable)) {
                return self::sortable()
                    ->where('product_translations.locale', app()->getLocale())
                    ->get();
            }
        }

        return self::sortable()

            ->get();
    }

}
