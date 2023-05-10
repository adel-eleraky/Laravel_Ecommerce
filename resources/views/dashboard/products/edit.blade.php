@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Edit Product')

@section('main_content')

    <form action="{{ route("product.update" , $product->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Name" class="form-label">Name</label>
            <input type="Name" class="form-control" id="Name" name="name" value="{{ old('name' , $product->name) }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity' , $product->quantity) }}">
            @error('quantity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea class="form-control" id="details" name="details">{{ old('details' , $product->details) }}</textarea>
            @error('details')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="subcategory_id" class="form-label">parent SubCategory</label>
            <select name="subcategory_id" id="subcategory_id">
                @forelse ($parent_subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}" @selected( $subCategory->id == $product->subcategory_id )> {{ $subCategory->name }}</option>
                @empty
                    <option value="">no SubCategory found</option>
                @endforelse
            </select>
            @error('subcategory_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Choose Image</label>
            <input class="form-control" type="file" id="formFile" name="image" value="{{ $product->image }}">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <img style="width: 150px" src={{ asset('storage/' . $product->image) }} alt="Category Has No image">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
