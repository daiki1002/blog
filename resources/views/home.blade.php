@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="col-9 mx-auto">
    <div class="row gx-5">
        <div class="col-lg-3">
            <div class="bg-white align-items-center shadow-sm p-2 me-3 border">
                <form class="mb-3" action="{{ route('home') }}">
                    <label for="search_title">Title</label>
                    <div class="input-group">
                        <input type="search" name="search_title" id="search_title" class="form-control form-control-sm" value="{{ $search_title }}" placeholder="Search for Title">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <label for="category" class="form-label d-block fw-bold">Category</label>
                <form action="{{ route('home') }}">
                    @foreach($all_categories as $category)
                    <div class="form-check">
                        @if($category->id == $search_category)
                        <input type="radio" name="search_category" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input" checked>
                        @else
                        <input type="radio" name="search_category" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
                        @endif
                        <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary btn-sm w-100 mt-2">
                        Search for Category
                    </button>
                </form>
            </div>
        </div>
        <div class="col-lg-9">
            @if($all_posts->isNotEmpty())
                @foreach($all_posts as $post)
                    <div class="card mb-4">
                        <div class="card-header bg-white py-3">
                            <div class="row align-items-center">
                                <a href="{{ route('post.show', $post->id) }}" class="col-auto text-decoration-none text-dark">
                                    <h4 class="fw-bold mb-0">{{ $post->title }}</h4>
                                </a>
                                <p class="col text-muted mb-0 mt-2 ps-0 small">created by {{ $post->user->name }}</p>
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
                            <img src="{{ asset('/storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="w-100">
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
                                        <img src="{{ asset('/storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="delete-post-img w-25">
                                        @endif
                                        <p class="text-muted">{{ $post->description }}</p>
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
                @endforeach
            @elseif($all_posts->isEmpty() && $search_title || $search_category)
                <div class="text-center">
                    <h2>No posts match your search.</h2>
                </div>
            @else
                <div class="text-center">
                    <h2>NO POSTS YET</h2>
                    <a href="{{ route('post.create') }}" class="text-decoration-none">Share your first posts</a>
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-center">
            {{ $all_posts->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
