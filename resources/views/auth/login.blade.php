@extends('layouts.layout')

@section('title', 'Login')

@section('content')
<div class="container mt-5">
    <div class="card mx-auto border-0">
        <div class="card-header bg-white border-0">
            <h1 class="display-4 fw-bold text-primary text-center">Login Blog</h1>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                    <div class="col-md-4">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                    <div class="col-md-4">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 offset-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
