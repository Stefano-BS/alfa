@extends('layout.master')

@section('titolo','Alfa')

@section('barraAccesso')
@if ($logged)
    <li><a href="{{ route('paginaUtente', ['utente' => $loggedName])}}"><span class="glyphicon glyphicon-user"></span>  {{$loggedName}}</a></li>
    <li><a href="{{ route('uscita') }}"><span class="glyphicon glyphicon-log-out"></span>  Esci</a></li>
@else
    <li class='active'><a href="{{ route('accesso')  }}"><span class="glyphicon glyphicon-user"></span>  Accedi</a></li>
@endif
@endsection

@section('corpo')
<br>
<div class="container">
    <div class=""row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-group">
                <div class="panel {{ ($messaggio =="Accesso"? "panel-default" : "panel-danger") }}">
                    <div class="panel-heading text-center">
                        <strong><h3>{{ $messaggio }}</h3></strong>
                    </div>
                    <div class="panel-body">
                        <div id="login-form">
                            <form id="login-form" action="{{ route('accesso') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="Nome utente">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <input type="submit" name="login-submit" class="form-control btn btn-danger" value="Accedi">
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <input type="submit" name="login-submit" class="form-control btn btn-danger" value="Registrati">
                                        </div>
                                    </div>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection