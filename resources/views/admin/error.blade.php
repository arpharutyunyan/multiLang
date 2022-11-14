<!--
=========================================================
Material Dashboard PRO - v2.2.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard-pro
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Admin Dashboard
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('assets/css/material-dashboard.css?v=2.2.2')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet" />
</head>

<body class="off-canvas-sidebar">
<!-- End Navbar -->
<div class="wrapper wrapper-full-page">
    <div class="page-header error-page header-filter" style="background-image: url({{asset('assets/img/clint-mckoy.jpg')}})">
        <!--   you can change the color of the filter page using: data-color="blue | green | orange | red | purple" -->
        <div class="content-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title">{{$code}}</h1>
                    <h2>{{$error}} :(</h2>
                    <h4>Please check your email address.</h4>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
