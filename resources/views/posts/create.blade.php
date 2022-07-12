@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<div class="col-8 mx-auto">
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            @error('title')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label d-block fw-bold">Category</label>
            @foreach($all_categories as $category)
            <div class="form-check form-check-inline">
                <input type="radio" name="category" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
                <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
            </div>
            @endforeach
            @error('category')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <input type="file" name="image" class="form-control">
            @error('image')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary px-5">Post</button>
    </form>
</div>
@endsection
