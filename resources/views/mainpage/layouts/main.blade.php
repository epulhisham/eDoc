<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Doc</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/css/dashboard.rlt.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  </head>
<body>
    
@include('mainpage.layouts.header')

<div class="container-fluid">
    <div class="row">
        @include('mainpage.layouts.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @yield('container')
        </main>
    </div>
</div>


<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/feather.min.js"></script>
<script src="/js/chart.min.js"></script>
<script src="/js/dashboard.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>
</body>
</html>
