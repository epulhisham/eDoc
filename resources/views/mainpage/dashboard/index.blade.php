@extends('mainpage.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <span data-feather="calendar"></span>
       This week
    </div>   
</div>
<canvas class="my-4 w-100" id="myChart" width="500" height="180"></canvas>
@endsection