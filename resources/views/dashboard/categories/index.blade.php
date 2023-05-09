@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'Categories')

@section('main_content')


    <a href="{{ route("category.create") }}" class="btn btn-primary mb-4">Create New Category</a>
    @if (session('success'))
        <div class="alert alert-success"> {{ session('success') }} </div>
    @endif
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
                    <td><img style="width: 150px" src="{{ asset('storage/' . $category->image) }}" alt="Category Has No Image" /></td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ asset($category->slug) }}</td>
                    <td>
                        <a href="{{ route("category.edit" , $category->id ) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route("category.destroy" , $category->id ) }}" method="post" class="d-inline">
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
@endsection
