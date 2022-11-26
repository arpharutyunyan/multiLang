<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'price' => 'required|integer',
            'category_id' => 'required',
            'screen_size',
            'ram',
            'memory',
            'main_camera',
            'front_camera',
            'battery_capacity',
            'os',
            'manufacturer_id' => 'required'
        ];

        // adding in rules translatable attributes with language code like 'en.title'
        $locales = config('translatable.locales')::all();
        foreach ($locales as $locale){
            $rules[$locale['code'].'.title'] = 'required|string';
            $rules[$locale['code'].'.description'] = 'required|string';
        }

        return $rules;
    }
}
