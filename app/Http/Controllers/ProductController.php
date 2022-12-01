<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTranslation;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Termwind\renderUsing;

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
        $this->deleteImageDir('temp');
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
        $item = Product::create($request->input());

        // fill in productCategory table
        ProductCategory::updateOrCreate(
            ['product_id' => $item->id],
            ['category_id' => $request['category_id']]
        );

        ProductTranslation::createOrUpdate($request->validated(), $item->id);

        // move image from tamp into folder with name equals product id
        $this->saveImages($item->id);

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
        $details = $product->getOriginal();

        // get list of images for given product id
        $files = $this->getImages($product->id);

        return view('product.show', compact('product', 'details', 'files'));
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

        // get list of images for given product id
        $files = $this->getImages($product->id);

        return view('product.createOrEdit', compact(['product', 'categories', 'manufacturers', 'files']));
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

        // move image from tamp into folder with name equals product id
        $this->saveImages($product->id);

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
        // delete folder
        $this->deleteImageDir($product->id);
        $product->delete();

        return redirect()->route('product.index');
    }

    // work with form for uploading file
    // save images in the temp folder
    public function imageUpload(Request $request){

        if ($request->hasFile('file')){

            $images = $request->file('file');
            $filename = $images->getClientOriginalName();

            $images->storeAs('temp', $filename);

        }
    }

    // work after submit
    // move image from temp folder into folder with product id
    public function saveImages($id){

        $images = $this->getImages('temp');
        for ($i=0; $i<count($images); ++$i){
            $filename = 'image'.$i.'.'.explode('.', $images[$i]['name'], 2)[1];
            Storage::move($images[$i]['name'], $id.'/'.$filename);
        }

        // after moving all files delete temporary folder
        $this->deleteImageDir('temp');
    }

    // delete folder with given parameters
    public function deleteImageDir($id){
        if (Storage::disk('public')->exists($id)) {

            Storage::deleteDirectory($id);
        }
    }

    // get list of images
    // return array with filename, size and path
    public function getImages($path){
        $files = [];
        $existFiles = Storage::disk('public')->allFiles($path);

        foreach ($existFiles as $file){

            $size = Storage::size($file);
            $path = asset('storage/products/'.$file);
            $files[] = ['name' => $file, 'size' => $size, 'path' => $path];
        }

        return $files;
    }

    // delete only image
    public function imageDelete(Request $request){
        Storage::disk('public')->delete($request->name);
    }
}
