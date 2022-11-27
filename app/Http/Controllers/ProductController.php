<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTranslation;
use Illuminate\Http\Request;
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
//        dd($request);

        $item = Product::create($request->input());

        // fill in productCategory table
        ProductCategory::updateOrCreate(
            ['product_id' => $item->id],
            ['category_id' => $request['category_id']]
        );

        ProductTranslation::createOrUpdate($request->validated(), $item->id);
        $this->imageUpload($request, $item->id);

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

        $this->imageUpload($request, $product->id);
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
        $this->deleteImageDir($product->id);
        $product->delete();


        return redirect()->route('product.index');
    }

    public function imageUpload($request, $id){

        if ($request->hasFile('image')){
            $this->deleteImageDir($id);

            if (!file_exists('../storage/app/uploads/'.$id)) {
                mkdir('../storage/app/uploads/'.$id);
            }

            $images = $request->file('image');
            for ($i=0; $i<count($images); ++$i){
                $filename = 'image'.$i.'.'.$images[$i]->getClientOriginalExtension();
                $path = ($request->image)[$i]->storeAs($id, $filename);
            }

        }
    }

    public function deleteImageDir($id){
        $folder = '../storage/app/uploads/'.$id;
        if (file_exists($folder)) {

            $files = glob($folder . '/*');

            // Loop through the file list
            foreach($files as $file) {

                // Check for file
                if(is_file($file)) {

                    // Use unlink function to delete the file.
                    unlink($file);
                }
            }
            rmdir($folder);
        }
    }

    public function getImages($id, ){
        $folder = '../storage/app/uploads/'.$id;
        $files = glob($folder . '/*');

//        if ($index < count($files)){
//            return $files[$index];
//        }
        return $files;
    }
}
