<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('page_title')</title>
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    {{--placeholder for additional css --}}
    @yield('css')


</head>
<body>

{{--nav bar--}}
<header class="navbar navbar-default navbar-fixed-top" role="navigation">

    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#navMenu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="nav navbar-nav">
                <li id="home" class="active" href="#"><a href="#">Home{{Route::getCurrentRoute()->getActionName()}}</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

            </ul>


        </div>
    </div>

</header>

<div class="container">
    {{--placeholder for content--}}
    @yield('content')
</div>



{{--placeholder for additional js--}}
@yield('js')
</body>
</html>