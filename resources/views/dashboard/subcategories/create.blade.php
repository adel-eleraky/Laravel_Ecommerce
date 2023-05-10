@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Create SubCategory')

@section('main_content')

    <form action="{{ route("subcategory.store") }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="Name" class="form-label">Name</label>
            <input type="Name" class="form-control" id="Name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea class="form-control" id="details" name="details">{{ old('details') }}</textarea>
            @error('details')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">parent Category</label>
            <select name="category_id" id="category_id">
                @forelse ($parent_categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                @empty
                    <option value="">no category found</option>
                @endforelse
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Choose Image</label>
            <input class="form-control" type="file" id="formFile" name="image">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection

@section('js')
<script>
    document.querySelector('#category_id').value = "";
</script>
@endsection
