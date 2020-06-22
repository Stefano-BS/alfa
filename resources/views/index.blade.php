@extends('layout.master')

@section('titolo','Alfa')

@section('barraAccesso')
<?php
    require_once('barra.php');
    if (!defined("loggedName")) barra($logged, "", "");
    else barra($logged, $loggedName, "");
?>
@endsection

@section('corpo')
<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-9" id="colonna">
            <header>
                <h1>@lang('str.titoloHome')</h1>
            </header>
            <p class="lead">@lang('str.intro1')<br>
            @lang('str.intro2')<br>
            @lang('str.intro3')</p>
            <br>
            <blockquote>
                <p>@lang('str.cit')</p>
                <small>Walter Benjamin</small>
            </blockquote>
        </div>
        <div class="col-sm-3">
            <div id="spazioColonna"></div>
            <a data-toggle="collapse" href="#-{{$corpo->ID}}" role="button" aria-expanded="false">
                <img id="corpoMacchina" src="{{route('home')}}/img/{{$corpo->Nome}}.png" width="100%">
            </a>
            <div class="collapse text-center" id="-{{$corpo->ID}}">
                <div class="card card-body">
                    <br>
                    <h3><span class="label label-default">Sony {{$corpo->Nome}}</span></h3>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row text-center">
        @foreach ($obbiettivi as $elemento)
        <div class="col-md-3 col-xs-12 align-middle">
            <a data-toggle="collapse" href="#{{$elemento->ID}}" role="button" aria-expanded="false">
                <img name='obbiettivo' src="{{route('home')}}/img/{{$elemento->ID}}.png" width="10%">
            </a>
            <div class="collapse" id="{{$elemento->ID}}">
                <div class="card card-body">
                    <h3><span class="label label-default">{{$elemento->{'Nome Completo'} }}</span></h3>
                </div>
            </div>
        </div>
        @endforeach
    </div>
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