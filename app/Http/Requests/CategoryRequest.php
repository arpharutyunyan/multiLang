<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [];

        // adding in rules translatable attributes with language code like 'en.title'
        $locales = config('translatable.locales')::all();
        foreach ($locales as $locale){
            $rules[$locale['code'].'.title'] = 'required|string';
        }

        return $rules;
    }
}
