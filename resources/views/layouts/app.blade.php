<!DOCTYPE html>
<html lang="en">

<head>
    <!--   Include: HEAD   -->
    @include('common.header.head')
</head>

<body class="g-sidenav-show  bg-gray-100">

<!-- Include: SIDENAV -->
@include('common.header.sidenav')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Include: NAVBAR -->
    @include('common.header.navbar')

    <div class="container-fluid py-4">
        <!-- Include: CONTENT -->
        @yield('content-dashboard')

        {{-- <!-- Include: FOOTER --> --}}
        {{-- @include('common.footer.footer') --}}
    </div>
</main>


<!--   Include: Config BTN   -->
@include('common.footer.config_btn')

<!--   Include: Script APP   -->
@include('common.scripts.app_script')
</body>

</html>
