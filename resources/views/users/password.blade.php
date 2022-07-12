@extends('layouts.app')

@section('title', 'Update Password')

@section('content')
<div class="col-6 mx-auto">
    @if(session('warning'))
        <div class="alert alert-danger" role="alert">
            {{ session('warning') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white shadow-sm p-4">
        <h3 class="text-muted fw-light">Update Password</h3>
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            @method('PATCH')
            
            <div class="my-3">
                <label for="current_password" class="form-label fw-bold">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control">
                @if(session('error_current_password'))
                    <p class="text-danger small">{{ session('error_current_password') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label fw-bold">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control">
                <p class="text-muted small mb-0">Your password must be at least 8 characters and contain letters and numbers.</p>
                @if(session('error_new_password'))
                    <p class="text-danger small">{{ session('error_new_password') }}</p>
                @endif
                @error('new_password')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

            </div>
            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label fw-bold">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-warning px-5">Update Password</button>
        </form>
    </div>
</div>
@endsection
