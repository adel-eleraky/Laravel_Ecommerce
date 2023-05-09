@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Products')

@section('main_content')

    <a href="{{ route("product.create") }}" class="btn btn-primary mb-4">Create New Product</a>
    <table class="table center">
        <thead class="table-dark">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Image</td>
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
                    <td>{{ $product->image }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->slug }}</td>
                    <td>
                        <a href="{{ route("product.edit" , $product->id ) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route("product.destroy" , $product->id ) }}" method="post" class="d-inline">
                            @csrf
                            @method("delete")
                            <a class="btn btn-danger">Delete</a>
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
@endsection
