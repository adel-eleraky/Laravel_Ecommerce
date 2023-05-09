@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Create SubCategory')

@section('main_content')

    <form action="{{ route("subcategory.store") }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="Name" class="form-label">Name</label>
            <input type="Name" class="form-control" id="Name" name="name">
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea class="form-control" id="details" name="details"></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Choose Image</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
