@extends('layout.master')

@section('titolo','Alfa: Obbiettivi')

@section('barraAccesso')
<?php
    require_once('barra.php');
    barra("");
?>
@endsection

@section('corpo')
<script>
    document.getElementById('navObbiettivi').setAttribute('class', 'active');
</script>
<div class="container">
    <header>
        <h1 align="center">@lang('str.catalogo') @lang('str.obbiettivi')</h1>
    </header>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="panel-group">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><a data-toggle="collapse" href="#collapse1"><span class="glyphicon glyphicon-filter"></span>  @lang('str.filtraElenco')</a></h3>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <form  id="select-form" action="
                        @if ($modifica)
                        {{ route ('obbiettivi', ['modifica' => "modifica"]) }}
                        @else
                        {{ route('obbiettivi') }}
                        @endif
                       " method="post" class="form-horizontal text-center">
                        @csrf 
                        <div class="container">
                            <div class="panel-body">
                                <h3 class="text-center">@lang('str.selezionaAttributi')</h3>
                                <div class="form-group">
                                    <label class="checkbox-inline"><input type="checkbox" name="ID" {{ $elencoAttributi["ID"] }}">ID</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Marca" {{ $elencoAttributi["Marca"] }}>@lang('str.marca')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Nome" {{ $elencoAttributi["Nome"] }}>@lang('str.nomeCompleto')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Rating" {{ $elencoAttributi["Rating"] }}>@lang('str.rating')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="LMin" {{ $elencoAttributi["LMin"] }}>@lang('str.lmin')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="LMax" {{ $elencoAttributi["LMax"] }}>@lang('str.lmax')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="F" {{ $elencoAttributi["F"] }}>@lang('str.apertura')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="FLMax" {{ $elencoAttributi["FLMax"] }}>@lang('str.apertura') @lang('str.amaxf')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="TAG"  {{ $elencoAttributi["TAG"] }}>TAG</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="OSS" {{ $elencoAttributi["OSS"] }}>@lang('str.stabilizzazione')</label>
                                </div>
                            </div>
                            <div class="panel-body">
                                <h3 class="text-center">@lang('str.filtraElenco')</h3>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2 col-md-offset-1">
                                            <label for="sel-marca">@lang('str.marca'):</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control" name="sel-marca" id="sel-marca">
                                            @foreach ($listaMarche as $marca)
                                                @if ($marca == $marcaSelezionata)
                                                    <option selected>{{$marca}}</option>
                                                @else
                                                    <option>{{$marca}}</option>
                                                @endif
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                                    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
                                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                                    <script>
                                    $(function() {
                                        $("#focal-range").slider({
                                            range: true,
                                            min: 1,
                                            max: 350,
                                            values: [ "{{$focaliSelezionate[0]}}", "{{$focaliSelezionate[1]}}" ],
                                            slide: function( event, ui ) {
                                                $( "#focale" ).val("Focale: " + ui.values[ 0 ] + " - " + ui.values[ 1 ] + " mm");
                                            }
                                        });
                                        $("#focale").val("@lang('str.focale'): " + $("#focal-range").slider("values", 0) + " - " + $("#focal-range").slider("values", 1) + " mm");
                                    });
                                    </script>
                                    <div class="row">
                                        <div class="col-md-2 col-md-offset-1 align-content-center">
                                            <input type="text" name="focal-range" id="focale" readonly style="border: 0; font-weight:bold;">
                                        </div>
                                        <div class="col-md-8 align-content-center">
                                            <div id="focal-range"></div>
                                        </div>
                                    </div>
                                    <script>
                                    $(function() {
                                    $("#aperture-range").slider({
                                            range: true,
                                            min: 0.8,
                                            max: 8,
                                            step: 0.1,
                                            values: [ "{{$apertureSelezionate[0]}}", "{{$apertureSelezionate[1]}}" ],
                                            slide: function( event, ui ) {
                                                $( "#apertura" ).val("Apertura: f" + ui.values[ 0 ] + " - f" + ui.values[ 1 ]);
                                            }
                                        });
                                        $("#apertura").val("@lang('str.apertura'): f" + $("#aperture-range").slider("values", 0) + " - f" + $("#aperture-range").slider("values", 1));
                                    });
                                    </script>
                                    <div class="row" data-toggle="tooltip" title="@lang('str.aiutoApertura')">
                                        <div class="col-md-2 col-md-offset-1 align-content-center">
                                            <input type="text" name="aperture-range" id="apertura" readonly style="border: 0; font-weight:bold;">
                                        </div>
                                        <div class="col-md-8 align-content-center">
                                            <div id="aperture-range"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer" style="background-color: rgba(0,0,0,0);">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12 col-md-offset-3">
                                        <input type="submit" name="select-submit" class="form-control btn btn-danger" value="@lang('str.applica')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-responsive" style="width:100%">
                <thead>
                    <tr>
                        @if ($elencoAttributi["ID"] !== "")
                        <th>ID</th>
                        @endif
                        @if ($elencoAttributi["Marca"] !== "")
                        <th>@lang('str.marca')</th>
                        @endif
                        @if ($elencoAttributi["Nome"] !== "")
                        <th>@lang('str.nomeCompleto')</th>
                        @endif
                        @if ($elencoAttributi["Rating"] !== "")
                        <th>@lang('str.rating')</th>
                        @endif
                        @if ($elencoAttributi["LMin"] !== "")
                        <th>@lang('str.lmin')</th>
                        @endif
                        @if ($elencoAttributi["LMax"] !== "")
                        <th>@lang('str.lmax')</th>
                        @endif
                        @if ($elencoAttributi["F"] !== "")
                        <th>@lang('str.maxf')</th>
                        @endif
                        @if ($elencoAttributi["FLMax"] !== "")
                        <th>F@LMax</th>
                        @endif
                        @if ($elencoAttributi["TAG"] !== "")
                        <th>TAG</th>
                        @endif
                        @if ($elencoAttributi["OSS"] !== "")
                        <th>OSS</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elenco as $obbiettivo)
                    <tr onclick="window.location.href = '{{ route('modificaObbiettivo', ['obbiettivo' => $obbiettivo->ID, 'modifica' => ($modifica? "modifica" : "visualizza")]) }}';">
                        @if ($elencoAttributi["ID"] !== "")
                        <td>{{$obbiettivo->ID}}</td>
                        @endif
                        @if ($elencoAttributi["Marca"] !== "")
                        <td>{{$obbiettivo->Marca}}</td>
                        @endif
                        @if ($elencoAttributi["Nome"] !== "")
                        <td>{{ $obbiettivo->{'Nome Completo'} }}</td>
                        @endif
                        @if ($elencoAttributi["Rating"] !== "")
                        <td>
                        <?php
                        if (strlen($obbiettivo->Rating) <2) {echo '<span class="label label-danger">';}
                        else if (strlen($obbiettivo->Rating) ==2) {echo '<span class="label label-warning">';}
                        else if (strlen($obbiettivo->Rating) ==3) {echo '<span class="label label-success">';}
                        else if (strlen($obbiettivo->Rating) ==4) {echo '<span class="label label-info">';}
                        else {echo '<span class="label label-primary">';}
                        for($i=0;$i<5;$i++){ //Necessario linguaggio PHP per non aver uno spazio tra le stelle
                            echo ($i<strlen($obbiettivo->Rating)?'<span class="glyphicon glyphicon-star"></span>':'<span class="glyphicon glyphicon-star-empty"></span>');
                        }?>
                        </span>
                        </td>
                        @endif
                        @if ($elencoAttributi["LMin"] != "")
                        <td>{{$obbiettivo->LMin}}</td>
                        @endif
                        @if ($elencoAttributi["LMax"] != "")
                            @if ($obbiettivo->LMax !== $obbiettivo->LMin)
                            <td>{{$obbiettivo->LMax}}</td>
                            @else
                            <td></td>
                            @endif
                        @endif
                        @if ($elencoAttributi["F"] != "")
                        <td>ƒ{{$obbiettivo->F}}</td>
                        @endif
                        @if ($elencoAttributi["FLMax"] != "")
                            @if ($obbiettivo->FLMax !== 0.0)
                            <td>ƒ{{$obbiettivo->FLMax}}</td>
                            @else
                            <td></td>
                            @endif
                        @endif
                        @if ($elencoAttributi["TAG"] != "")
                        <td>{{$obbiettivo->TAG}}</td>
                        @endif
                        @if ($elencoAttributi["OSS"] != "")
                        <td>
                            @if ($obbiettivo->OSS == true)
                            <span class="label label-success">✔</span>
                            @else
                            <span class="label label-danger">✖</span>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection