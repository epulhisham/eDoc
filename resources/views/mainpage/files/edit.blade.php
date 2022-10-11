@extends('mainpage.layouts.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit {{ $file->document_name }}</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/mainpage/files/{{ $file->id }}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="document_name" class="form-label">Document title</label>
                <input type="text" class="form-control @error('document_name') is-invalid @enderror" id="document_name" name="document_name" required autofocus value="{{ old('document_name', $file->document_name) }}">
                @error('document_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>      
                @enderror
            </div>
            <div class="mb-3">
                <label for="reference_no" class="form-label">Reference no.</label>
                <input type="text" class="form-control @error('reference_no') is-invalid @enderror" id="reference_no" name="reference_no" required autofocus value="{{ old('reference_no', $file->reference_no) }}">
                @error('reference_no')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>      
                @enderror
            </div>
            <div class="mb-3">
                <label for="version" class="form-label">Version</label>
                <input type="text" class="form-control  @error('version') is-invalid @enderror" id="version" name="version" required autofocus value="{{ old('version', $file->version) }}">
                @error('version')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>      
                @enderror
            </div>
            <div class="mb-3">
                <label for="release_date" class="form-label">Release date</label>
                <input type="text" class="form-control @error('release_date') is-invalid @enderror" id="datepicker" name="release_date" required autofocus value="{{ old('release_date', $file->release_date) }}">
                @error('release_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>      
                @enderror
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Storage Location</label>
                <select class="form-select" name="location_id">
                    @foreach ($locations as $location )
                        @if (old('location_id', $file->location->id) == $location->id)
                            <option value="{{ $location->id }}" selected>{{ $location->location_name }}</option>
                        @else
                            <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="classification" class="form-label">Document Classification</label>
                <select class="form-select" name="classification_id">
                    @foreach ($classifications as $classification )
                        @if (old('classification_id', $file->classification->id ) == $classification->id)
                            <option value="{{ $classification->id }}" selected>{{ $classification->classification_name }}</option>
                        @else
                            <option value="{{ $classification->id }}">{{ $classification->classification_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Uploaded Files</label>
                    <input type="hidden" name="oldformFileMultiple" value="{{ $file->formFileMultiple }}">
                    <input class="form-control @error('formFileMultiple') is-invalid @enderror" type="file" id="formFileMultiple" name="formFileMultiple" multiple>
                    @error('formFileMultiple')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>      
                @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-dark">Update File</button>
        </form>
    </div>


@endsection