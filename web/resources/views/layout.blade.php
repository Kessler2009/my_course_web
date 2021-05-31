

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>



<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://fonts.googleapis.com/css?family=Helvetica+Neue&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Exo+2&display=swap"
      rel="stylesheet"
    />


    <link rel="stylesheet" href="../css/mysitestyle.css" />
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
 <script type="text/javascript" src="public/js/jquery-2.1.4.min.js"></script>
  <link rel="stylesheet" href="public/js/main-calc.css">
    <link rel="stylesheet" href="public/css/style-calc.css">







    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/css/style.css') }}">

    <link rel="stylesheet" href="{{ URL::to('resources/css/mysitestyle.css') }}">
    <link href="{{ asset('resources/css/mysitestyle.css') }}" rel="stylesheet"  >
    <link rel="stylesheet" href="resources/css/mysitestyle.css" />
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css" />



    <link rel="stylesheet" type="text/css" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/style.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>





<div>
    @yield('header')
</div>










<div class="container page" style="width: 100%; margin: 0 auto; margin-top: 80px; padding: 0 40px; padding-top: 80px; padding-bottom: 100px">
    @yield('content')
</div>

@yield('footer')

@yield('scripts')
</body>
</html>
