<?php

namespace App\Models;

use App\Http\Requests\CategoryRequest;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $fillable = [
        'parent_id'
    ];

    public $translatedAttributes = ['title'];

    protected $translationForeignKey = 'item';

    public function parent(){
        return $this->belongsTo(Category::class);
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    // return array of all categories with translatable fields
    public static function getItemsWithTranslation(){

        return self::withTranslation()
                    ->translatedIn(app()->getLocale())
                    ->get();
    }

}
