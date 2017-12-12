<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Techshop28 Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('adminresource/css/bootstrap.min.css') }}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('adminresource/css/style.blue.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('adminresource/css/custom.css') }}">
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    <script src="https://use.fontawesome.com/99347ac47f.js"></script>

    {{-- main datatable --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.16/b-1.4.2/b-colvis-1.4.2/b-flash-1.4.2/b-html5-1.4.2/b-print-1.4.2/cr-1.4.1/r-2.2.0/rr-1.2.3/datatables.min.css"/>
 
    <!-- Font Icons CSS-->
    <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
    <div id="app">
        <div class="page home-page">
            @include('inc.adminnavbar')
            <div class="page-content d-flex align-items-stretch">
                @include('inc.adminsidebar')
                <div class="content-inner">
                    <header class="page-header">
                        <div class="container-fluid">
                          <h2 class="no-margin-bottom">@yield('header')</h2>
                        </div>
                    </header>
                    @include('inc.adminmessages')
                    @yield('content')
                    <!-- Page Footer-->
                    <footer class="main-footer">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-sm-6">
                          <p>Techshop28 Shop and Go &copy; 2017-2019</p>
                        </div>
                      </div>
                    </div>
                  </footer>
                </div>
            </div>
            
            @include('inc.adminjavascripts')
        </div>
    </div>
</body>
</html>
