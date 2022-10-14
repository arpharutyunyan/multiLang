<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public $fillable = [
        'code'
    ];

    public function category_translations(){
        return $this->belongsTo(CategoryTranslation::class);
    }
}
