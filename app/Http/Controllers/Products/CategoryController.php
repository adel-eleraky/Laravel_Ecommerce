<?php

namespace App\Http\Controllers\Products;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories =  Category::all();

        return view("dashboard.categories.index" , compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // validate inputs
        $request->validate(Category::rules());

        // merge slug input to the request
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);


        // remove image input from request
        $data = $request->except('image');

        // upload image to public disk
        if($request->hasFile('image')){

            $file = $request->file('image');

            $path = $file->store('uploads' , ['disk' => 'public']);

            $data['image'] = $path;
        }

        Category::create($data);

        return Redirect::route('category.index')->with('success' , "Category Created Successfully");

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
        $category =  Category::findOrFail($id);

        return view("dashboard.categories.edit" , compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $category = Category::findOrFail($id);

        $request->validate(Category::rules($id));

        // merge slug input to the request
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);


        // remove image input from request
        $data = $request->except('image');

        // upload image to public disk
        if($request->hasFile('image')){

            $file = $request->file('image');

            $path = $file->store('uploads' , ['disk' => 'public']);

            // save image path in data array
            $data['image'] = $path;

            // delete old image
            $old_image = $category->image;

            if($old_image){
                Storage::disk('public')->delete($old_image);
            }
        }


        $category->update($data);

        return Redirect::route('category.index')->with('success' , "Category Updated Successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // delete old image
        if($category->image){
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return Redirect::route('category.index')->with('success' , 'Category Deleted Successfully');
    }
}
