@extends('layout.master')

@section('titolo','Alfa')

@section('barraAccesso')
@if ($logged)
    <li><a href="{{ route('paginaUtente', ['utente' => $loggedName])}}"><span class="glyphicon glyphicon-user"></span>  {{$loggedName}}</a></li>
    <li><a href="{{ route('uscita') }}"><span class="glyphicon glyphicon-log-out"></span>  Esci</a></li>
@else
    <li><a href="{{ route('accesso')  }}"><span class="glyphicon glyphicon-user"></span>  Accedi</a></li>
@endif
@endsection

@section('corpo')
<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-9" id="colonna">
            <header>
                <h1>Meraviglioso sito Alfa</h1>
            </header>
            <p class="lead">Un semplicissimo esempio di sito web realizzato durante il corso di Programmazione Web e Servizi Digitali.<br>
            Entro questo sito è possibile consultare un catalogo di gran parte degli obbiettivi disponibili per Sony E-Mount (esclusivamente quelli in formato APS-C) e conoscerne le caratteristiche principali.
            Allo stesso modo, sono catalogati i corpi macchina più recenti (a partire dal 2014).<br>
            Al fine di personalizzare l'interazione col catalogo, un utente registrato può dichiarare un articolo come <i>posseduto o desiderato</i>. Per ognuno di questi è infine possibile effettuare ricerche rapide di annunci di vendita sui principali portali online.</p>
            <br>
            <blockquote>
                <p>Non colui che ignora l'alfabeto, bensì colui che ignora la fotografia sarà l'analfabeta del futuro.</p>
                <small>Walter Benjamin</small>
            </blockquote>
        </div>
        <div class="col-sm-3">
            <div id="spazioColonna"></div>
            <a data-toggle="collapse" href="#-{{$corpo->ID}}" role="button" aria-expanded="false">
                <img id="corpoMacchina" src="{{route('home')}}/img/{{$corpo->Nome}}.png" width="100%">
            </a>
            <div class="collapse" id="-{{$corpo->ID}}">
                <div class="card card-body">
                    <br><em><center>Sony {{$corpo->Nome}}</em></center>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row"><center>
        @foreach ($obbiettivi as $elemento)
        <div class="col-md-3 col-xs-12 align-middle">
            <a data-toggle="collapse" href="#{{$elemento->ID}}" role="button" aria-expanded="false">
                <img name='obbiettivo' src="{{route('home')}}/img/{{$elemento->ID}}.png" width="10%">
            </a>
            <div class="collapse" id="{{$elemento->ID}}">
                <div class="card card-body">
                    <em><center>{{$elemento->{'Nome Completo'} }}</em></center>
                </div>
            </div>
        </div>
        @endforeach
    </center></div>
    <script>
        var altezzaColonna = document.getElementById('colonna').clientHeight;
        var topColonna = document.getElementById('colonna').getBoundingClientRect().top;
        var altezzaCorpo = document.getElementById('corpoMacchina').clientHeight;
        var topCorpo = document.getElementById('corpoMacchina').getBoundingClientRect().top;
        
        if (topColonna === topCorpo) document.getElementById('spazioColonna').style.height = (altezzaColonna-altezzaCorpo)/2 + "px";
        
        var immagini = document.getElementsByName('obbiettivo');
        for (var i=0; i<immagini.length; i++) {
            immagini[i].setAttribute("width","100%");
            var larghezza = immagini[i].clientWidth;
            if (immagini[i].clientHeight > larghezza) { //Immagini alte
                immagini[i].style.width = (larghezza*0.99)*larghezza / immagini[i].clientHeight + "px";
                immagini[i].style.height = (larghezza*0.99) + "px";
            }
        }
    </script>
</div>
@endsection