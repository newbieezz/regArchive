<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Registrar Archive</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/logo.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/js/config.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/pdf_viewer.min.css')}}"/>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        @include('layouts.sidebar')
        
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page" style="width: 100%;">
          <!-- Navbar - HEADER w/search -->
          @include('layouts.header')
          <!-- / Navbar -->

          <!-- Content wrapper - BODY Container -->
          <div class="content-wrapper">
            <!-- Content -->
                @yield( 'content' )
            <!-- / Content -->

            <!-- Footer -->
            @include( 'layouts.footer' )
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>

    <script src="{{asset('assets/js/html2canvas.js')}}"></script>
    <script src="{{asset('assets/js/jspdf.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

    <!-- Vendors JS -->
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{asset('assets/js/pdf.min.js')}}"></script>
    <script src="{{asset('assets/js/pdf.worker.entry.min.js')}}"></script>
    <script src="{{asset('assets/js/pdf.worker.min.js')}}" ></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>
    @yield('scripts')
  </body>
</html>
