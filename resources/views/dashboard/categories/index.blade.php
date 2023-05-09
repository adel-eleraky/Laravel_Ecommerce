@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Categories')

@section('main_content')

    <a href="{{ route("category.create") }}" class="btn btn-primary mb-4">Create New Category</a>
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
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->image }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <a href="{{ route("category.edit" , $category->id ) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route("category.destroy" , $category->id ) }}" method="post" class="d-inline">
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
