@extends('layouts.app')

@section('title', 'Show Post')

@section('content')
<div class="card col-6 mx-auto">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <h4 class="col-auto fw-bold mb-0">{{ $post->title }}</h4>
            <p class="col text-muted mb-0 mt-1 ps-0 small">created by {{ $post->user->name }}</p>
            @if(Auth::user()->id === $post->user->id)
            <div class="col-auto">
                <div class="dropdown">
                    <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $post->id }}">
                            <i class="fa-regular fa-trash-can"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @if($post->image)
    <div class="container p-0">
        <img src="{{ $post->image }}" alt="{{ $post->image }}" class="w-100">
    </div>
    @endif
    <div class="card-body">
        <div class="badge bg-secondary bg-opacity-50 text-wrap mb-2">
            {{ $post->category->name }}
        </div>
        <p class="card-text mb-0">{{ $post->description }}</p>
        <div class="row align-items-center">
            <div class="col">
                <p class="card-text text-muted mt-2 small">{{ date('d-m-y', strtotime($post->created_at)) }}</p>
            </div>
            <div class="col-auto">
                @if($post->isLiked())
                <form action="{{ route('like.delete', $post->id) }}" method="post" class="mt-2">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-sm shadow-none ps-0"><i class="fa-solid fa-thumbs-up text-warning"></i></button>
                    <p class="small d-inline mt-2">{{ $post->likes->count() }}</p>
                </form>
                @else
                <form action="{{ route('like.store', $post->id) }}" method="post" class="mt-2">
                    @csrf

                    <button type="submit" class="btn btn-sm shadow-none ps-0"><i class="fa-regular fa-thumbs-up"></i></button>
                    <p class="small d-inline mt-2">{{ $post->likes->count() }}</p>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger"><i class="fa-solid fa-circle-exclamation"></i> Delete Post</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this post?</p>
                <div class="mt-3">
                    <p class="text-muted mb-0">Title: {{ $post->title }}</p>
                    @if($post->image)
                    <img src="{{ $post->image }}" alt="{{ $post->image }}" class="delete-post-img w-25">
                    @endif
                    <p class="mt-1 text-muted">{{ $post->description }}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('post.delete', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
