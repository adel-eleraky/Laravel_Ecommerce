@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Create SubCategory')

@section('main_content')

    <form action="{{ route("subcategory.store") }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <x-form.label for="name">Name</x-form.label>
            <x-form.input type="text" id="name" name="name"  />
        </div>
        <div class="mb-3">
            <x-form.label for="details">Details</x-form.label>
            <x-form.textarea id="details" name="details"  />
        </div>
        <div class="mb-3">
            <x-form.label for="scategory_id">Parent Category</x-form.label>
            <x-form.select id="category_id" name="category_id" :options="$parent_categories" notFound="Category" />
        </div>
        <div class="mb-3">
            <x-form.label for="image">Choose image</x-form.label>
            <x-form.input type="file" name="image" id="image" />
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection

@section('js')
<script>
    document.querySelector('#category_id').value = "";
</script>
@endsection
