<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('titolo')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <!--meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"-->
        <link rel="stylesheet" href="{{ route('home') }}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ route('home') }}/css/stile.css">
        <link rel="shortcut icon" type="image/x-icon" href="{{ route('home') }}/favicon.ico"/>
        <!--script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script-->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ route('home') }}/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar-default">
            <div class="container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
                   <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home')}}">Alfa</a>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <!--li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catalogo<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('corpi')}}">Corpi Macchina</a></li>
                                <li><a href="{{ route('obbiettivi')}}">Obbiettivi</a></li>
                            </ul>
                        </li-->
                        <li><a href="{{ route('corpi')}}">Corpi</a></li>
                        <li><a href="{{ route('obbiettivi')}}">Obbiettivi</a></li>
                        <li><a href="{{ route('strumenti')}}">Strumenti</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    @yield('barraAccesso')
                    </ul>
                </div>
            </div>
        </nav>
        @yield('corpo')
    </body>
</html>