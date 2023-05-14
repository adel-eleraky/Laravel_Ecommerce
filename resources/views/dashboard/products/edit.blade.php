@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Edit Product')

@section('main_content')

    <form action="{{ route("products.update" , $product->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <x-form.label for="name" >Name</x-form.label>
            <x-form.input id="name" name="name" type="text" :value="$product->name" />
        </div>
        <div class="mb-3">
            <x-form.label for="quantity" >Quantity</x-form.label>
            <x-form.input id="quantity" name="quantity" type="number" :value="$product->quantity" />
        </div>
        <div class="mb-3">
            <x-form.label for="details" >Details</x-form.label>
            <x-form.textarea id="details" name="details" :value="$product->details" />
        </div>
        <div class="mb-3">
            <x-form.label for="subcategory_id" >Parent SubCategory</x-form.label>
            <x-form.select id="subcategory_id" name="subcategory_id" :options="$parent_subCategories" notFound="SubCategory" />
        </div>
        <div class="mb-3">
            <x-form.label for="image" >Choose Image</x-form.label>
            <x-form.input  type="file" id="image" name="image" />
            <img style="width: 150px" src={{ asset('storage/' . $product->image) }} alt="Product Has No image">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
