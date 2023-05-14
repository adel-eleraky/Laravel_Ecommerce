@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Create Product')

@section('main_content')

    <form action="{{ route("products.store") }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <x-form.label for="name">Name</x-form.label>
            <x-form.input type="text" id="name" name="name"  />
        </div>
        <div class="mb-3">
            <x-form.label for="quantity">Quantity</x-form.label>
            <x-form.input type="number" id="quantity" name="quantity"  />
        </div>
        <div class="mb-3">
            <x-form.label for="details">Details</x-form.label>
            <x-form.textarea id="details" name="details"  />
        </div>
        <div class="mb-3">
            <x-form.label for="subcategory_id">Parent SubCategory</x-form.label>
            <x-form.select id="subcategory_id" name="subcategory_id" :options="$parent_subCategories" notFound="subCategory" />
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
    document.querySelector("#subcategory_id").value = "";
</script>
@endsection