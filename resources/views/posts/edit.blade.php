@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="col-8 mx-auto">
    <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}">
            @error('title')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label d-block fw-bold">Category</label>
            @foreach($all_categories as $category)
            <div class="form-check form-check-inline">
                @if($category->id == $selected_category)
                <input type="radio" name="category" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input" checked>
                @else
                <input type="radio" name="category" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
                @endif

                <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
            </div>
            @endforeach
            @error('category')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $post->description) }}</textarea>
            @error('description')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <div class="col-6">
                @if($post->image)
                <img src="{{ asset('/storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="img-thumbnail w-100">
                @endif
                <input type="file" name="image" class="form-control mt-1">
                @error('image')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success px-5">Save</button>
    </form>
</div>
@endsection
