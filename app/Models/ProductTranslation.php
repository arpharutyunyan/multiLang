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

    // if find the item in table update, if not, create
    public static function createOrUpdate($request, $id)
    {

        $locales = config('translatable.locales')::all();

        foreach ($locales as $locale) {

            $locale = $locale['code'];

            // find items with given locale
            $findItem = self::where('item', $id)
                ->where('locale', $locale)
                ->first();
            if ($findItem) {

                $findItem->update(['title' => $request[$locale]['title'],
                    'description' => $request[$locale]['description']
                    ]);

            }else{

                $item = new ProductTranslation();
                $item->item = $id;
                $item->locale = $locale;
                $item->title = $request[$locale]['title'];
                $item->description = $request[$locale]['description'];

                $item->save();
            }
        }
    }

    //get category as params and add translated key
    public static function prepareData(&$item){

        $locales = config('translatable.locales')::all();

        foreach($locales as $locale) {
            $locale = $locale['code'];

            $data = self::where('item', $item->id)
                ->where('locale', $locale)
                ->first();

            //add key like 'en.title'
            $item[$locale.'.title'] = $data['title'];
            $item[$locale.'.description'] = $data['description'];

        }

        // get category id with given product id
        $category = ProductCategory::select(['category_id'])
            ->where('product_id', $item->id)
            ->first();

        // get category title
        $category = CategoryTranslation::where('item', $category['category_id'])
            ->where('locale', app()->getLocale())
            ->first();

        // set category in the request array
        if ($category){
            $item['category'] = $category['title'];
        }

    }

}
