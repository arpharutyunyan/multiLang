<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $fillable = [
        'price'
    ];

    public function translations(){
        return $this->belongsTo(ProductTranslation::class);
    }

    public function category(){
        return $this->belongsTo(ProductCategory::class);
    }
}
