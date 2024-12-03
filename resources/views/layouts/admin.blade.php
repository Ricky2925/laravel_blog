<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8">
        <title>Dashboard | Upcube - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesdesign" name="author">

        <!-- jquery.vectormap css -->
        <link href="{{asset('admin/static/css/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css">

        <!-- DataTables -->
        <link href="{{asset('admin/static/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">

        <!-- Responsive datatable examples -->
        <link href="{{asset('admin/static/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">  

        <!-- Bootstrap Css -->
        <link href="{{asset('admin/static/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{asset('admin/static/css/icons.min.css')}}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{asset('admin/static/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css">

    </head>

    <body data-topbar="dark">
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        @include('layouts.admin-header') <!-- 引入header -->
    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        @include('layouts.admin-left') <!-- 引入left -->
    </div>
<!-- Left Sidebar End -->
        @yield('content') <!-- 动态加载不同的页面内容 -->
        @include('layouts.admin-footer') <!-- 引入left -->
 
            