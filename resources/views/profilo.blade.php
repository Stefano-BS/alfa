@extends('layout.master')

@if ($logged)
@section('titolo',$loggedName)
@else
@section('titolo','Alfa')
@endif

@section('barraAccesso')
@if ($logged)
    <li class='active'><a href="{{ route('paginaUtente', ['utente' => $loggedName])}}"><span class="glyphicon glyphicon-user"></span>  {{$loggedName}}</a></li>
    <li><a href="{{ route('uscita') }}"><span class="glyphicon glyphicon-log-out"></span>  Esci</a></li>
@else
    <li><a href="{{ route('accesso')  }}"><span class="glyphicon glyphicon-user"></span>  Accedi</a></li>
@endif
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <header>
                <br>
                <h1 align="center">{{ $loggedName }}</h1>
                <br>
            </header>
            @if ($admin)
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <strong>Pannello di Amministrazione</strong>
                    </div>
                    <div class="panel-body">
                        <a href="{{ route('obbiettivi', ['modifica' => "modifica"]) }}" class="btn btn-warning btn-large btn-block">
                        <span class="glyphicon glyphicon-pencil"></span> Modifica obbiettivi</a>
                        <a href="{{ route('corpi', ['modifica' => "modifica"]) }}" class="btn btn-warning btn-large btn-block">
                        <span class="glyphicon glyphicon-pencil"></span> Modifica corpi macchina</a>
                    </div>
                </div>
            </div>
            <br>
            @endif
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <strong>Lista dei Desideri</strong>
                    </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover table-responsive" style="width:100%">
@foreach ($desideriCorpo as $desiderio)
<tr onclick="window.location.href = '{{ route('modificaCorpo', ['corpo' => $desiderio->ID, 'modifica' => 'visualizza']) }}';">
    <td>Sony {{$desiderio->Nome}}</td>
    <td><a href="{{route('rimozioneDesiderioCorpo', ['utente' => $loggedName, 'id' => $desiderio->ID])}}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-trash"></span>  Rimuovi</button></td></tr>
@endforeach
@foreach ($desideri as $desiderio)
<tr onclick="window.location.href = '{{ route('modificaObbiettivo', ['obbiettivo' => $desiderio->ID, 'modifica' => 'visualizza']) }}';">
    <td>{{$desiderio->{'Nome Completo'} }}</td>
    <td><a href="{{route('rimozioneDesiderioObbiettivo', ['utente' => $loggedName, 'id' => $desiderio->ID])}}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-trash"></span>  Rimuovi</button></td></tr>
@endforeach
                    </table>
                </div>
            </div>
            <br>
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <strong>Articoli posseduti</strong>
                    </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover table-responsive" style="width:100%">
@foreach ($possessiCorpo as $possesso)
<tr onclick="window.location.href = '{{ route('modificaCorpo', ['corpo' => $possesso->ID, 'modifica' => 'visualizza']) }}';">
    <td>Sony {{$possesso->Nome}}</td>
    <td><a href="{{route('rimozionePossessoCorpo', ['utente' => $loggedName, 'id' => $possesso->ID])}}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-trash"></span>  Rimuovi</button></td></tr-->
@endforeach
@foreach ($possessi as $possesso)
<tr onclick="window.location.href = '{{ route('modificaObbiettivo', ['obbiettivo' => $possesso->ID, 'modifica' => 'visualizza']) }}';">
    <td>{{$possesso->{'Nome Completo'} }}</td>
    <td><a href="{{route('rimozionePossessoObbiettivo', ['utente' => $loggedName, 'id' => $possesso->ID])}}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-trash"></span>  Rimuovi</button></td></tr-->
@endforeach
                    </table>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection