<?php

namespace App\Models;

use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class CategoryTranslation extends Model
{
    use HasFactory;

    public $fillable = [
        'title'
    ];


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

                $findItem->update(['title' => $request[$locale]['title']]);

            }else{

                $item = new CategoryTranslation();
                $item->item = $id;
                $item->locale = $locale;
                $item->title = $request[$locale]['title'];

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

            //add key like 'en.title'
            $item[$locale.'.title'] = self::where('item', $item->id)
                ->where('locale', $locale)
                ->first()['title'];
        }

        // set parent title in the request array by getting parent_id from request
        $parent = self::where('item', $item->parent_id)
            ->where('locale', app()->getLocale())
            ->first();

        if ($parent){
            $item['parent'] = $parent;
        }
    }

}
