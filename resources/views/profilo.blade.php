@extends('layout.master')

@if ($logged)
@section('titolo',$loggedName)
@else
@section('titolo','Alfa')
@endif

@section('barraAccesso')
@if ($logged)
    <li class='active'><a href="{{ route('paginaUtente', ['utente' => $loggedName])}}"><span class="glyphicon glyphicon-user"></span>  {{$loggedName}}</a></li>
    <li><a href="{{ route('uscita') }}"><span class="glyphicon glyphicon-log-out"></span>  @lang('str.esci')</a></li>
@else
    <li><a href="{{ route('accesso')  }}"><span class="glyphicon glyphicon-user"></span>  @lang('str.accedi')</a></li>
@endif
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <header>
                <br>
                <h1 align="center" style="word-wrap: break-word;">{{ $loggedName }}</h1>
                <br>
            </header>
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <strong>@lang('str.pannelloAdmin')</strong>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="get">
                                @csrf
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2"><h5 class='pull-right'>@lang('str.lingua'):</h5></div>
                                    <div class='col-sm-4 selectLingua'>
                                        <select name="lingua" id="lingua" class="form-control"
                                        onchange="location.href = '{{route('paginaUtente', ['utente' => $loggedName])}}/cambialingua/' + document.getElementById('lingua').value;">
                                            <option value="en" @if ($lingua == 'en') selected @endif>🇬🇧  English</option>
                                            <option value="it" @if ($lingua == 'it') selected @endif>🇮🇹  Italiano</option>
                                        </select></font>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if ($admin)
                        <br>
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <a href="{{ route('obbiettivi', ['modifica' => "modifica"]) }}" class="btn btn-warning btn-large btn-block">
                                <span class="glyphicon glyphicon-pencil"></span> @lang('str.modifica') @lang('str.obbiettivi')</a>
                            </div>
                            <div class="col-md-0 col-xs-12"> </div>
                            <div class="col-md-6 col-xs-12">
                                <a href="{{ route('corpi', ['modifica' => "modifica"]) }}" class="btn btn-warning btn-large btn-block">
                                <span class="glyphicon glyphicon-pencil"></span> @lang('str.modifica') @lang('str.corpi')</a>
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
                                <td onclick="window.location.href = '{{ route('modificaCorpo', ['corpo' => $desiderio->ID, 'modifica' => 'visualizza']) }}';">Sony {{$desiderio->Nome}}</td>
                                <td><a data-toggle="modal" data-target="#confermaEliminazione" onclick="eliminazione(event, 'Sony {{$desiderio->Nome}}', '{{route('rimozioneDesiderioCorpo', ['utente' => $loggedName, 'id' => $desiderio->ID])}}');" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-trash"></span>  @lang('str.rimuovi')</button></td></tr>
                            @endforeach
                            @foreach ($desideri as $desiderio)
                            <tr>
                                <td onclick="window.location.href = '{{ route('modificaObbiettivo', ['obbiettivo' => $desiderio->ID, 'modifica' => 'visualizza']) }}';">{{$desiderio->{'Nome Completo'} }}</td>
                                <td><a data-toggle="modal" data-target="#confermaEliminazione" onclick="eliminazione(event, '{{$desiderio->{'Nome Completo'} }}', '{{route('rimozioneDesiderioObbiettivo', ['utente' => $loggedName, 'id' => $desiderio->ID])}}');" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-trash"></span>  @lang('str.rimuovi')</button></td></tr>
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
                                <td onclick="window.location.href = '{{ route('modificaCorpo', ['corpo' => $possesso->ID, 'modifica' => 'visualizza']) }}';">Sony {{$possesso->Nome}}</td>
                                <td><a data-toggle="modal" data-target="#confermaEliminazione" onclick="eliminazione(event, 'Sony {{$possesso->Nome}}', '{{route('rimozionePossessoCorpo', ['utente' => $loggedName, 'id' => $possesso->ID])}}');" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-trash"></span>  @lang('str.rimuovi')</button></td></tr>
                            @endforeach
                            @foreach ($possessi as $possesso)
                            <tr>
                                <td onclick="window.location.href = '{{ route('modificaObbiettivo', ['obbiettivo' => $possesso->ID, 'modifica' => 'visualizza']) }}';">{{$possesso->{'Nome Completo'} }}</td>
                                <td><a data-toggle="modal" data-target="#confermaEliminazione" onclick="eliminazione(event, '{{$possesso->{'Nome Completo'} }}', '{{route('rimozionePossessoObbiettivo', ['utente' => $loggedName, 'id' => $possesso->ID])}}');" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-trash"></span>  @lang('str.rimuovi')</button></td></tr>
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
            <center>
            <div class="modal-header">
                <h4 class="modal-title" id="nomeArticolo"></h4>
            </div>
            <div class="modal-body">
                <h4 class="modal-title">@lang('str.confermaEliminazione')</h4>
            </div>
            </center>
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
</script>
@endsection