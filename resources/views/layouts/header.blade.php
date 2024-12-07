<!-- resources/views/layouts/header.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- Bootstrap styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Font-Awesome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">

    <!-- Google Webfonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600|PT+Serif:400,400italic' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" id="theme-styles">

    <!--[if lt IE 9]>      
        <script src="js/respond.js"></script>
    <![endif]-->
    <style>
        .logout-btn {
            color: #444;
            text-decoration: none; /* Remove underline */
            font-size: 16px;
        }

        .logout-btn:hover {
            color: red; /* Change color to red on hover */
            text-decoration: none; /* Ensure no underline on hover */
        }
    </style>
</head>
<body>
    <header>
        <div class="widewrapper masthead">
            <div class="container">
                <a href="/" id="logo">
			<h1 style='color:red;'>Explore Tesla</h1>
                </a>

                <div id="mobile-nav-toggle" class="pull-right">
                    <a href="#" data-toggle="collapse" data-target=".clean-nav .navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>

                <nav class="pull-right clean-nav">
                    <div class="collapse navbar-collapse">
                        <ul class="nav nav-pills navbar-nav">
                            @if(auth()->check())
                                <li><a href="">Username : {{auth()->user()->name}}</a></li>
                                @if(auth()->user()->is_admin == 1)<li><a href=""> administrator</a></li>@endif
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-link logout-btn">Logout</button>
                                    </form>
                                </li>
                                <li><a href="{{ route('admin.login') }}">Backend Management</a></li>
                            @else
                                <li><a href="{{ route('register') }}">Register</a></li>
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('admin.login') }}">Backend Management</a></li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="widewrapper subheader">
            <div class="container">
                <div class="clean-breadcrumb">
                    <a href="#">Blog</a>
                </div>

                
            </div>
        </div>
    </header>
