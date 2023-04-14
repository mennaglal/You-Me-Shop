<!DOCTYPE html>
<html lang="en">
<head>
    @include('dashboard.layouts.header')
    @yield("css")
</head>
<body class="alt-menu sidebar-noneoverflow">

 <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">
        <!--  BEGIN NAVBAR  -->
        <div class="header-container fixed-top">
            @include('dashboard.layouts.navbar')
        </div>
        <!--  END NAVBAR  -->

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('dashboard.layouts.sidebar')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            @yield('content')

        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->

    @include('dashboard.layouts.footer-scripts')
    @yield("js")
</body>
</html>
