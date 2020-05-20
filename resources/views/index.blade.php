@extends('layout.master')

@section('titolo','Alfa')

@section('barraAccesso')
@if ($logged)
    <li><a href="{{ route('paginaUtente', ['utente' => $loggedName])}}"><span class="glyphicon glyphicon-user"></span>{{$loggedName}}</a></li>
    <li><a href="{{ route('uscita') }}"><span class="glyphicon glyphicon-log-out"></span>  Esci</a></li>
@else
    <li><a href="{{ route('accesso')  }}"><span class="glyphicon glyphicon-user"></span>Accedi</a></li>
@endif
@endsection

@section('corpo')
<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-9">
            <header>
                <h1>Meraviglioso sito Alfa</h1>
            </header>
            <p>Un semplicissimo esempio di sito web realizzato durante il corso di Programmazione Web e Servizi Digitali.
            Entro questo sito è possibile consultare un catalogo di tutti gli obbiettivi disponibili per Sony E-Mount (formato APS-C) e conoscerne le caratteristiche.
            Sono anche catalogati i corpi macchina più recenti.
            Ogni utente registrato può segnare come <i>posseduto o desiderato</i> un articolo.</p>
            <br>
             <blockquote>
                <p>Non colui che ignora l'alfabeto, bensì colui che ignora la fotografia sarà l'analfabeta del futuro.</p>
                <small>Walter Benjamin</small>
            </blockquote>
        </div>
        <div class="col-sm-3">
            <a data-toggle="collapse" href="#-{{$corpo->ID}}" role="button" aria-expanded="false">
                <img src="{{route('home')}}/img/{{$corpo->Nome}}.png" width="100%">
            </a>
            <div class="collapse" id="-{{$corpo->ID}}">
                <div class="card card-body">
                    <br><em><center>Sony {{$corpo->Nome}}</em></center>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($obbiettivi as $elemento)
        <div class="col-sm-3 col-xs-6">
            <a data-toggle="collapse" href="#{{$elemento->ID}}" role="button" aria-expanded="false">
                <img src="{{route('home')}}/img/{{$elemento->ID}}.png" width="100%">
            </a>
            <div class="collapse" id="{{$elemento->ID}}">
                <div class="card card-body">
                    <br><em><center>{{$elemento->{'Nome Completo'} }}</em></center>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection