@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Edit Category')

@section('main_content')

    <form action="{{ route('category.update'  , $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Name" class="form-label">Name</label>
            <input type="Name" class="form-control" id="Name" name="name" value="{{ old('name' , $category->name) }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea class="form-control" id="details" name="details">{{ old('details' , $category->details ) }}</textarea>
            @error('details')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Choose Image</label>
            <input class="form-control" type="file" id="formFile" name="image">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <img style="width: 150px" src={{ asset('storage/' . $category->image) }} alt="Category Has No image">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
