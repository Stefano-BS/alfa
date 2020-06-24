<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('titolo')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"-->
        <link rel="stylesheet" href="{{ route('/') }}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ route('/') }}/css/stile.css">
        <link rel="shortcut icon" type="image/x-icon" href="{{ route('/') }}/favicon.ico"/>
        <!--script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script-->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ route('/') }}/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar-default navbar-fixed-top" id='navbar'>
            <div class="container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
                   <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home')}}">Alfa</a>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="nav navbar-nav">
                        <li id="navCorpi"><a href="{{ route('corpi')}}">📷 @lang('str.corpi')</a></li>
                        <li id="navObbiettivi"><a href="{{ route('obbiettivi')}}">🔭 @lang('str.obbiettivi')</a></li>
                        <li id="navStrumenti"><a href="{{ route('strumenti')}}">🧮 @lang('str.strumenti')</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @yield('barraAccesso')
                    </ul>
                </div>
            </div>
        </nav>
        <div id='navSpazio'></div>
        <script>
            document.getElementById('navSpazio').style.height = document.getElementById('navbar').clientHeight + "px";
        </script>
        @yield('corpo')
    </body>
</html>