@extends('layouts.parent')

@section('title', 'ecommerce')

@section('content_title', 'SubCategories')

@section('main_content')

    <a href="{{ route("subcategory.create") }}" class="btn btn-primary mb-4">Create New SubCategory</a>
    <table class="table center">
        <thead class="table-dark">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Image</td>
                <td>Category_id</td>
                <td>Created At</td>
                <td>Slug</td>
                <td>Operations</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($subCategories as $subCategory)
                <tr>
                    <td>{{ $subCategory->id }}</td>
                    <td>{{ $subCategory->name }}</td>
                    <td>{{ $subCategory->image }}</td>
                    <td>{{ $subCategory->category_id }}</td>
                    <td>{{ $subCategory->created_at }}</td>
                    <td>{{ $subCategory->slug }}</td>
                    <td>
                        <a href="{{ route("subcategory.edit" , $subCategory->id ) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route("subcategory.destroy" , $subCategory->id ) }}" method="post" class="d-inline">
                            @csrf
                            @method("delete")
                            <a class="btn btn-danger">Delete</a>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td><P>No SubCategory Found</P></td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
