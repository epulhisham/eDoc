@extends('mainpage.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit {{ $folder->name }} folder</h1>
    </div>
    <div class="col-lg-8">
        <form method="post" action="/mainpage/folders/{{ $folder->slug }}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Folder name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name', $folder->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>      
                @enderror
            </div>
            <div class="mb-3">
                {{-- <label for="slug" class="form-label">Folder slug</label> --}}
                <input type="hidden" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug' , $folder->slug)  }}">
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>      
                @enderror
            </div>
            <button type="submit" class="btn btn-dark">Update Folder</button>
        </form>
    </div>

    <script>
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {

            fetch('/mainpage/folders/checkSlug?name=' + name.value)
                .then(response => response.json())
                .then(data=> slug.value = data.slug)
        })

    </script>
@endsection