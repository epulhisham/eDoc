@extends('mainpage.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $folders->name }}</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif


<a href="/mainpage/files/{{ $folders->slug }}/create" class="btn btn-dark mb-3">Create new file</a>

<div class="row">
    <div class="col-md-6">
        <form action="/mainpage/files/{{ $folders->slug }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
                <button class="btn btn-dark" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive col-lg-11">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
            <th scope="col">No.</th>
            <th scope="col">Document title</th>
            <th scope="col">Reference no.</th>
            <th scope="col">Version</th>
            <th scope="col">Released date</th>
            <th scope="col">Storage Location</th>
            <th scope="col">Document Classification</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file )
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $file->document_name }}</td>
                <td>{{ $file->reference_no }}</td>
                <td>{{ $file->version }}</td>
                <td>{{ $file->release_date }}</td>
                <td>{{ $file->location->location_name }}</td>
                <td>{{ $file->classification->classification_name }}</td>
                <td>
                    <a href="{{ $file->formFileMultiple }}" class="badge bg-info" target="_blank"><span data-feather="eye" class="align-text-bottom"></span></a>
                    <a href="/mainpage/files/{{ $file->id }}/edit" class="badge bg-warning"><span data-feather="edit" class="align-text-bottom"></span></a>
                    <form action="/mainpage/files/{{ $file->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" class="align-text-bottom"></span></button>
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{ $files->links() }}
    </div>
</div>



@endsection