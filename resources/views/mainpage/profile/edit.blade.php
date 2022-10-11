@extends('mainpage.layouts.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Profile: {{ auth()->user()->name }}</h1>
    </div>
    
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
        <a href="/mainpage/folders" class="stretched-link">Back to folder</a>
        </div>
    @endif

    <div class="col-lg-8">
        <form method="POST" action="/profile/{{ auth()->user()->id }}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name', auth()->user()->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>      
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required autofocus value="{{ old('username', auth()->user()->username) }}">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>      
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" required autofocus value="{{ old('email', auth()->user()->email) }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>      
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autofocus value="{{ old('password', auth()->user()->password) }}">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>      
                @enderror
            </div>
            <button type="submit" class="btn btn-dark">Update File</button>
        </form>
    </div>


@endsection