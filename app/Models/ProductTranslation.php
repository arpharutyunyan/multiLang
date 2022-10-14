<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;

    public $fillable = [
        'item',
        'language_code',
        'title',
        'description'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function languages(){
        return $this->hasMany(Language::class);
    }
}
