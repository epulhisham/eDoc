@extends('mainpage.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome, {{ auth()->user()->name }}</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-8">
    <a href="folders/create" class="btn btn-dark mb-3">Create folder</a>
    <table class="table table-striped table-sm col-md-5">
        <thead>
            <tr>
            <th scope="col">No.</th>
            <th scope="col">Folder name</th>
            <th scope="col">Created/Updated at</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $folders as $folder )
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $folder->name }}</td>
                <td>{{ $folder->updated_at->diffForHumans() }}</td>
                <td>
                    <a href="files/{{ $folder->slug }}" class="badge bg-info"><span data-feather="eye" class="align-text-bottom"></span></a>
                    <a href="/mainpage/folders/{{ $folder->slug }}/edit" class="badge bg-warning"><span data-feather="edit" class="align-text-bottom"></span></a>
                    <form action="/mainpage/folders/{{ $folder->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" class="align-text-bottom"></span></button>
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection