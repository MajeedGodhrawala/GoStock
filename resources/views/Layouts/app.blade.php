<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Nucleo Icons -->
    <link rel="stylesheet" href="{{asset('css/nucleo-icons.css')}}"> 
    <link rel="stylesheet" href="{{asset('css/nucleo-svg.css')}}"> 

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{asset('css/material-dashboard.css?v=3.1.0')}}"> 
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    {{-- <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script> --}}

    @vite('resources/js/app.js')
    @inertiaHead
  </head>
  <body class="g-sidenav-show  bg-gray-100">
    @inertia

    {{-- Script Start --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!--   Core JS Files   -->
    <script src="{{asset('js/core/popper.min.js')}}"></script>
    <script src="{{asset('js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="../../assets/js/plugins/dropzone.min.js"></script>
    {{-- <script src="{{asset('js/plugins/chartjs.min.js')}}"></script> --}}

    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc --><script src="{{asset('js/material-dashboard.min.js?v=3.1.0')}}"></script>


    <!-- Bootstrap core JavaScript-->
    {{-- <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script> --}}

    {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}

    {{-- Script End --}}
  </body>
</html>