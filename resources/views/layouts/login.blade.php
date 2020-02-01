<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('asset/assets/images/unand-logo.png')}}">
    <title>Portal Akademik Universitas Andalas</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('asset/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('asset/css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset('asset/css/colors/blue.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="error-page">
    <div class="error-box" style="background:#dcefdc;">
    <header class="header text-center" style="background:#006400; padding: 30px;">
    
    </header><br><br><br><br>
    <div class="login-box card" ><br>
            <a href="javascript:void(0)" class="text-center"><img src="{{asset('asset/assets/images/logo-light-icon.png')}}" alt="Home" /></a>
            <a href="javascript:void(0)" class="text-center"><img src="{{asset('asset/assets/images/logo-text.png')}}" style="width:160px;" alt="Home" /></a>
            <a href="javascript:void(0)" class="text-center"><img src="{{asset('asset/assets/images/tulisan-unand.png')}}" alt="Home" /></a>
            @yield('content')
    </div>
     <footer class="footer text-right" style="background:#006400; padding: 20px;">© 2019 Portal Akademik Universitas Andalas.</footer>
    </div>
    </section>
   
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('asset/assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('asset/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('asset/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('asset/js/waves.js')}}"></script>
</body>

</html>
