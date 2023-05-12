@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Edit SubCategory')

@section('main_content')

    <form action="{{ route("subcategory.update"  , $subCategory->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <x-form.label for="name" >Name</x-form.label>
            <x-form.input id="name" name="name" type="text" :value="$subCategory->name" />
        </div>
        <div class="mb-3">
            <x-form.label for="details" >Details</x-form.label>
            <x-form.textarea id="details" name="details" :value="$subCategory->details" />
        </div>
        <div class="mb-3">
            <x-form.label for="category_id" >Parent Category</x-form.label>
            <x-form.select id="category_id" name="category_id" :options="$parent_categories" notFound="Category" />
        </div>
        <div class="mb-3">
            <x-form.label for="image" >Choose Image</x-form.label>
            <x-form.input  type="file" id="image" name="image" />
            <img style="width: 150px" src={{ asset('storage/' . $subCategory->image) }} alt="SubCategory Has No image">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection

