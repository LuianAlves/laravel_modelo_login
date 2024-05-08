<!DOCTYPE html>
<html lang="en">

<head>
    <!--   Include: HEAD   -->
    @include('common.header.head')
</head>

<body class="">

<main class="main-content mt-0">
    <section>
        <div class="page-header min-vh-75">
            <div class="container">
                <!-- Include: CONTENT -->
                @yield('content-guest')
            </div>
        </div>
    </section>
</main>

<!--   Include: Script APP   -->
@include('common.scripts.app_script')
</body>

</html>
