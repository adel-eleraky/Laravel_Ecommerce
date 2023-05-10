<?php

namespace App\Http\Controllers\Products;

use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{

    private $data = [];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = Subcategory::all();

        return view("dashboard.subcategories.index" , compact("subCategories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $parent_categories = Category::select('id' , 'name')->get();

        return view("dashboard.subcategories.create" , compact('parent_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate inputs
        $request->validate(Subcategory::rules());

        // merge slug input to the request
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);


        // remove image input from request
        $this->data = $request->except('image');

        //
        $this->uploadImage($request);

        Subcategory::create($this->data);

        return Redirect::route('subcategory.index')->with('success' , "SubCategory Created Successfully");
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
        $subCategory = Subcategory::findOrFail($id);

        $parent_categories = Category::select('id' , 'name')->get();

        return view("dashboard.subcategories.edit" , compact("subCategory" , "parent_categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $subCategory = Subcategory::findOrFail($id);

        // validate inputs
        $request->validate(Subcategory::rules($id));

        // merge slug input to the request
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);


        // remove image input from request
        $this->data = $request->except('image');

        $this->uploadImage($request);

        // delete old image if exist
        $old_image = $subCategory->image;

        if($old_image && isset($this->data['image'])){
            Storage::disk('public')->delete($old_image);
        }

        $subCategory->update($this->data);

        return Redirect::route('subcategory.index')->with('success' , "SubCategory Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = Subcategory::findOrFail($id);

        // delete image if exist
        if($subCategory->image){
            Storage::disk('public')->delete($subCategory->image);
        }

        // delete subcategory
        $subCategory->delete();

        return Redirect::route('subcategory.index')->with('success' , 'SubCategory Deleted Successfully');

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
