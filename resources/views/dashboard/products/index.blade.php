@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Products')

@section('main_content')

    <a href="{{ route("products.create") }}" class="btn btn-primary mb-4">Create New Product</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table center">
        <thead class="table-dark">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Image</td>
                <td>quantity</td>
                <td>SubCategory_id</td>
                <td>Created At</td>
                <td>Slug</td>
                <td>Operations</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td><img width="150px" src="{{ asset('storage/'.$product->image ) }}" alt="Product Has No Image"></td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->subcategory_id }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->slug }}</td>
                    <td>
                        <a href="{{ route("products.edit" , $product->id ) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route("products.destroy" , $product->id ) }}" method="post" class="d-inline">
                            @csrf
                            @method("delete")
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td><P>No category Found</P></td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
