<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'description'
    ];

    public $sortable = ['title', 'description'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    // if find the item in table update, if not, create
    public static function createOrUpdate($request, $id)
    {
        // take all language code from config, with query, because variable takes model class name
        $locales = config('translatable.locales')::all();

        foreach ($locales as $locale) {

            $locale = $locale['code'];

            // find items with given locale
            $findItem = self::where('item', $id)
                ->where('locale', $locale)
                ->first();

            if ($findItem) {

                foreach ($request[$locale] as $field_name => $value){
                    $findItem->update([$field_name => $value]);
                }

            }else{

                $item = new ProductTranslation();
                $item->item = $id;
                $item->locale = $locale;

                foreach ($request[$locale] as $field_name => $value) {
                    $item->$field_name = $value;
                }

                $item->save();
            }
        }
    }

    //get category as params and add translated key
    public static function prepareData(&$item){

        // take all language code from config, with query, because variable takes model class name
        $locales = config('translatable.locales')::all();

        foreach($locales as $locale) {
            $locale = $locale['code'];

            $data = self::where('item', $item->id)
                ->where('locale', $locale)
                ->first();

            //add key like 'en.title'
            foreach ((new  Product())->translatedAttributes as $translatedAttributes){
                $item[$locale.'.'.$translatedAttributes] = $data[$translatedAttributes];
            }
        }

        // get category id with given product id
        $category = ProductCategory::select(['category_id'])
            ->where('product_id', $item->id)
            ->first();

        // get category title
        $parent = CategoryTranslation::where('item', $category['category_id'])
            ->where('locale', app()->getLocale())
            ->first();

        // set category in the request array
        if ($parent){
            $item['parent'] = $parent;
        }

    }

}
