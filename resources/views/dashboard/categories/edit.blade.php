@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Edit Category')

@section('main_content')

    <form action="{{ route('category.update'  , $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <x-form.label for="name">Name</x-form.label>
            <x-form.input type="text" id="name" name="name" :value="$category->name" />
        </div>
        <div class="mb-3">
            <x-form.label for="details">details</x-form.label>
            <x-form.textarea id="details" name="details" :value="$category->details" />
        </div>
        <div class="mb-3">
            <x-form.label for="image">Choose Image</x-form.label>
            <x-form.input type="file" id="image" name="image" />
            <img style="width: 150px" src={{ asset('storage/' . $category->image) }} alt="Category Has No image">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
