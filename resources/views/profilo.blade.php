@extends('layout.master')

@auth
@section('titolo',auth()->user()->name)
@else
@section('titolo','Alfa')
@endauth

@section('barraAccesso')
<?php
    require_once('barra.php');
    barra("class='active'");
?>
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <header class='text-center'>
                <br>
                @if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/laravel/public/utenti/" . auth()->user()->email) ||
                    file_exists($_SERVER['DOCUMENT_ROOT'] . "/utenti/" . auth()->user()->email))
                    <img id="imProfilo" onclick="window.location='{{route('/')}}/utenti/{{auth()->user()->email}}'" src='{{route('/')}}/utenti/{{auth()->user()->email}}' class='img-circle' style="box-shadow: 0px 0px 30px;"/>
                    <script>$("#imProfilo").fadeOut(0);</script>
                @endif
                <h1 align="center" style="word-wrap: break-word; text-shadow: 0px 0px 10px rgba(0,0,0,0.4); color: rgb(32,0,0);">
                    {{ auth()->user()->name }}</h1>
                <br>
            </header>
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <strong>@lang('str.pannelloAdmin')</strong>
                    </div>
                    <div class="panel-body">
                        <h4 class="hConLinea">@lang('str.impostazioni')</h4>
                        <div class="row">
                            <form method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <h5 class='pull-right'>@lang('str.nome'):</h5>
                                    </div>
                                    <div class="input-group col-sm-4">
                                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" id='cambionome'>
                                        <div class="input-group-btn">
                                            <a class="btn btn-default"
                                            onclick="location.href = '{{route('paginaUtente', ['utente' => auth()->user()->email])}}/cambianome/' + document.getElementById('cambionome').value">
                                                <i class="glyphicon glyphicon-floppy-save"></i>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3"> </div>
                                    
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <h5 class='pull-right'>@lang('str.immProfilo'):</h5>
                                    </div>
                                    <div class='col-sm-4'>
                                        <input type="file" class="immagineProfilo"  name="immagine" id="caricaImmProfilo" accept="image/x-png,image/jpeg" onchange="submit()"/>
                                        <label for="caricaImmProfilo">
                                            <h5><span class='glyphicon glyphicon-upload'></span>  @lang('str.caricaFile')  </h5>
                                        </label>
                                    </div>
                                    
                                    <div class="col-sm-2"> </div>
                                    
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <h5 class='pull-right'>@lang('str.lingua'):</h5>
                                    </div>
                                    <div class='col-sm-4 selectLingua'>
                                        <select name="lingua" id="lingua" class="form-control"
                                        onchange="location.href = '{{route('paginaUtente', ['utente' => auth()->user()->email])}}/cambialingua/' + document.getElementById('lingua').value;">
                                            <option value="en" @if ($lingua == 'en') selected @endif>🇬🇧  English</option>
                                            <option value="it" @if ($lingua == 'it') selected @endif>🇮🇹  Italiano</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if (auth()->user()->permessi)
                        <br>
                        <h4 class="hConLinea">@lang('str.amministrazione')</h4>
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <a href="{{ route('obbiettivi', ['modifica' => "modifica"]) }}" class="btn btn-warning btn-large btn-block">
                                <span class="glyphicon glyphicon-pencil"></span> @lang('str.modifica') @lang('str.obbiettivi')</a>
                            </div>
                            <div class="col-md-0 col-xs-12"> </div>
                            <div class="col-md-6 col-xs-12">
                                <a href="{{ route('creaObbiettivo') }}" class="btn btn-warning btn-large btn-block">
                                <span class="glyphicon glyphicon-plus"></span> @lang('str.creaNuovoObbiettivo')</a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <a href="{{ route('corpi', ['modifica' => "modifica"]) }}" class="btn btn-warning btn-large btn-block">
                                <span class="glyphicon glyphicon-pencil"></span> @lang('str.modifica') @lang('str.corpi')</a>
                            </div>
                            <div class="col-md-0 col-xs-12"> </div>
                            <div class="col-md-6 col-xs-12">
                                <a href="{{ route('creaCorpo') }}" class="btn btn-warning btn-large btn-block">
                                <span class="glyphicon glyphicon-plus"></span> @lang('str.creaNuovoCorpo')</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <strong>@lang('str.listaDesideri')</strong>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover table-responsive" style="width:100%">
                            @if ((count($desideriCorpo) + count($desideri)) == 0)
                            <center><em>@lang('str.suggerimentodesideri')</em></center>
                            @else
                            @foreach ($desideriCorpo as $desiderio)
                            <tr>
                                <td onclick="window.location.href = '{{ route('modificaCorpo', ['corpo' => $desiderio->ID, 'modifica' => 'visualizza']) }}';">
                                    Sony {{$desiderio->Nome}}</td>
                                <td><a data-toggle="modal" data-target="#confermaEliminazione" onclick="eliminazione(event, 'Sony {{$desiderio->Nome}}', '{{route('rimozioneDesiderioCorpo', ['utente' => auth()->user()->email, 'id' => $desiderio->ID])}}');" class="btn btn-danger btn-large btn-block">
                                    <span class="glyphicon glyphicon-trash"></span>  @lang('str.rimuovi')</button></td></tr>
                            @endforeach
                            @foreach ($desideri as $desiderio)
                            <tr>
                                <td onclick="window.location.href = '{{ route('modificaObbiettivo', ['obbiettivo' => $desiderio->ID, 'modifica' => 'visualizza']) }}';">
                                    {{$desiderio->{'Nome Completo'} }}</td>
                                <td><a data-toggle="modal" data-target="#confermaEliminazione" onclick="eliminazione(event, '{{$desiderio->{'Nome Completo'} }}', '{{route('rimozioneDesiderioObbiettivo', ['utente' => auth()->user()->email, 'id' => $desiderio->ID])}}');" class="btn btn-danger btn-large btn-block">
                                    <span class="glyphicon glyphicon-trash"></span>  @lang('str.rimuovi')</button></td></tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <strong>@lang('str.pannelloPossessi')</strong>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover table-responsive" style="width:100%">
                            @if ((count($possessiCorpo) + count($possessi)) == 0)
                            <center><em>@lang('str.suggerimentopossessi')</em></center>
                            @else
                            @foreach ($possessiCorpo as $possesso)
                            <tr>
                                <td onclick="window.location.href = '{{ route('modificaCorpo', ['corpo' => $possesso->ID, 'modifica' => 'visualizza']) }}';">
                                    Sony {{$possesso->Nome}}</td>
                                <td><a data-toggle="modal" data-target="#confermaEliminazione" onclick="eliminazione(event, 'Sony {{$possesso->Nome}}', '{{route('rimozionePossessoCorpo', ['utente' => auth()->user()->email, 'id' => $possesso->ID])}}');" class="btn btn-danger btn-large btn-block">
                                    <span class="glyphicon glyphicon-trash"></span>  @lang('str.rimuovi')</button></td></tr>
                            @endforeach
                            @foreach ($possessi as $possesso)
                            <tr>
                                <td onclick="window.location.href = '{{ route('modificaObbiettivo', ['obbiettivo' => $possesso->ID, 'modifica' => 'visualizza']) }}';">
                                    {{$possesso->{'Nome Completo'} }}</td>
                                <td><a data-toggle="modal" data-target="#confermaEliminazione" onclick="eliminazione(event, '{{$possesso->{'Nome Completo'} }}', '{{route('rimozionePossessoObbiettivo', ['utente' => auth()->user()->email, 'id' => $possesso->ID])}}');" class="btn btn-danger btn-large btn-block">
                                    <span class="glyphicon glyphicon-trash"></span>  @lang('str.rimuovi')</button></td></tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

<div id="confermaEliminazione" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title" id="nomeArticolo"></h4>
            </div>
            <div class="modal-body text-center">
                <h4 class="modal-title">@lang('str.confermaEliminazione')</h4>
            </div>
            <div class="modal-footer">
                <div class="container">
                <div class="row">
                    <button type="button" class="btn btn-danger col-sm-5 col-xs-12" data-dismiss="modal" id='confermaFinale'>@lang('str.rimuovi')</button>
                    <div class="col-md-0 col-xs-12"> </div>
                    <button type="button" class="btn btn-default col-sm-5 col-xs-12 pull-right" data-dismiss="modal">@lang('str.annulla')</button>
                </div></div>
            </div>
        </div>
    </div>
</div>

<script>
function eliminazione(event, nome, link) {
    document.getElementById("nomeArticolo").innerHTML = nome;
    document.getElementById("confermaFinale").setAttribute("onclick", "window.location.href = \"" + link + "\"");
}

img = document.getElementById("imProfilo");
if (img) {
    img.setAttribute("width","50%");
    img.setAttribute("height", img.parentNode.offsetWidth/2);
    img.setAttribute("width", img.height);
    $("#imProfilo").fadeIn(1000);
}
</script>
@endsection