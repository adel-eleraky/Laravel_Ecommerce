<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{

    private $data = [];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(4);
        return view("dashboard.products.index" , compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parent_subCategories = Subcategory::select('id' , 'name')->get();
        return view("dashboard.products.create" , compact('parent_subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate inputs
        $request->validate(Product::rules());

        // add slug input to the request
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        // remove image input from the request
        $this->data = $request->except('image');

        // store image if exits
        $this->uploadImage($request);

        // create product
        Product::create($this->data);

        return Redirect::route('products.index')->with('success' , "Product Created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        $parent_subCategories = Subcategory::select('id' , 'name')->get();
        return view("dashboard.products.edit" , compact("product" , "parent_subCategories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // validate inputs
        $request->validate(Product::rules($id));

        // merge slug input to the request
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);


        // remove image input from request
        $this->data = $request->except('image');

        $this->uploadImage($request);

        // delete old image if exist
        $old_image = $product->image;

        if($old_image && isset($this->data['image'])){
            Storage::disk('public')->delete($old_image);
        }

        $product->update($this->data);

        return Redirect::route('products.index')->with('success' , "Product Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // delete image if exist
        if($product->image){
            Storage::disk('public')->delete($product->image);
        }

        // delete product
        $product->delete();

        return Redirect::route('products.index')->with('success' , "Product Deleted Successfully");
    }

    // function to upload image
    public function uploadImage(Request $request)
    {
        // upload image to public disk
        if($request->hasFile('image')){

            $file = $request->file('image');

            $path = $file->store('uploads' , ['disk' => 'public']);

            $this->data['image'] = $path;
        }
    }
}
