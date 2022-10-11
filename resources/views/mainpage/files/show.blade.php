@extends('mainpage.layouts.main')

@section('container')

<iframe src="{{ asset('storage/' . $file->formFileMultiple) }}" width="100%" height="100%"></iframe>

@endsection