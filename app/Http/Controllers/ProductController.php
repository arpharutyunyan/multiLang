<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTranslation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        // get all products with translation
        $data = Product::getItemsWithTranslation();

//         sort with url parameters without any packages and plugins
//        $data = Product::getItemsByOrdered(\request()->query());

        // sorting with laravel sortable packages
//        $data = Product::sortWithLaravelSortable(\request()->query());

        return view('product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
//        $product = Product::getItemsWithTranslation();
//        dd($product);
        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        return view('product.createOrEdit', compact('categories', 'manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        dd($request);
        $item = Product::create($request->input());

        // fill in productCategory table
        ProductCategory::updateOrCreate(
            ['product_id' => $item->id],
            ['category_id' => $request['category_id']]
        );

        ProductTranslation::createOrUpdate($request->validated(), $item->id);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product)
    {
        // prepare data for viewing all tables in one request
        ProductTranslation::prepareData($product);
//        $product = $product->getOriginal();
        $details = $product->getOriginal();
        return view('product.show', compact('product', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        ProductTranslation::prepareData($product);

        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        return view('product.createOrEdit', compact(['product', 'categories', 'manufacturers']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        ProductTranslation::createOrUpdate($request->validated(), $product->id);

        // update product table
//        $product->price = $request->price;
//        $product->save();
        $product->update($request->input());

        // update productCategory table
        ProductCategory::updateOrCreate(
            ['product_id' => $product->id],
            ['category_id' => $request['category_id']]
        );

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }
}
