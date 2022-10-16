<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = Category::withTranslation()
            ->translatedIn(app()->getLocale())
            ->get();

        return view('category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::withTranslation()
            ->translatedIn(app()->getLocale())
            ->get();

        return view('category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
//        dd($request->validated());
        $category = Category::create($request->validated());
        $locales = config('translatable.locales')::all();
        foreach(config('translatable.locales')::all() as $locales){
            $cat_trans = new CategoryTranslation();
            $cat_trans->item = $category->id;
            $cat_trans->locale = $locales['code'];
            $cat_trans->title = $request->validated()[$locales['code']]['title'];

            $cat_trans->save();
        }

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categories = $category;

        // show translation with all languages
        $locales = config('translatable.locales')::select(['code'])->get();
        foreach($locales as $locale) {
            $locale = $locale['code'];
            $categories[$locale.'.title'] = CategoryTranslation::where('item', $category->id)
                ->where('locale', $locale)
                ->get()[0]['title'];
        }

        return view('category.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
//        $categories = $category;

        // show translation with all languages
        $locales = config('translatable.locales')::select(['code'])->get();
        foreach($locales as $locale) {
            $locale = $locale['code'];
            $category[$locale.'.title'] = CategoryTranslation::where('item', $category->id)
                ->where('locale', $locale)
                ->get()[0]['title'];
        }

        $categories = Category::all();

        return view('category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $request->validated();
        $category->parent_id = $request->parent_id;
        $category->save();
//        $locales = config('translatable.locales')::all();
        foreach(config('translatable.locales')::all() as $locales){
            CategoryTranslation::where('item', $category->id)
                ->where('locale', $locales['code'])
                ->update(['title' => $request->validated()[$locales['code']]['title']]);
        }

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index');

    }
}
