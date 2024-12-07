<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Home')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- Include global CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600|PT+Serif:400,400italic" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" id="theme-styles">
</head>
<body>
    @include('layouts.header') <!-- Include header -->

    @yield('content') <!-- Dynamically load different page content -->

    @include('layouts.footer') <!-- Include footer -->
</body>
</html>
