<!--
=========================================================
* Material Dashboard 3 - v3.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    {{ $title }}
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('sig/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('sig/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('sig/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
  <link id="pagestyle" rel="stylesheet" href="{{ asset ('fe/css/styles.css') }}">
  <!-- Swal -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  

</head>
<link rel="icon" href="{{ asset('image/logo.png') }}">
<body class="g-sidenav-show  bg-gray-100 main-content">

    @yield('sidebar')
      <!-- Content Start -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      @yield('navbar2')
        @yield('content')
        <!-- Content End -->
        <!-- Back to Top -->
    </main>

  <!--   Core JS Files   -->
  <script src="{{ asset('sig/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('sig/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('sig/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('sig/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('sig/js/plugins/chartjs.min.js') }}"></script>

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
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('sig/js/material-dashboard.min.js?v=3.2.0"') }}></script>
</body>

</html>