@extends('layout.master')

@section('titolo','Alfa: Corpi macchina')

@section('barraAccesso')
<?php
    require_once('barra.php');
    barra("");
?>
@endsection

@section('corpo')
<script>
    document.getElementById('navCorpi').setAttribute('class', 'active');
</script>
<div class="container">
    <header>
        <h1 align="center">@lang('str.catalogo') @lang('str.corpi')</h1>
    </header>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="panel-group">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><a data-toggle="collapse" href="#collapse1"><span class="glyphicon glyphicon-filter"></span>  @lang('str.selezionaAttributi')</a></h3>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <form  id="select-form" action="
                        @if ($modifica)
                        {{ route ('corpi', ['modifica' => "modifica"]) }}
                        @else
                        {{ route('corpi') }}
                        @endif
                       " method="post" class="form-horizontal text-center">
                        @csrf 
                        <div class="container">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="checkbox-inline"><input type="checkbox" name="ID" {{ $elencoAttributi["ID"] }}">ID</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Nome" {{ $elencoAttributi["Nome"] }}>@lang('str.nome')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Data" {{ $elencoAttributi["Data"] }}>@lang('str.data')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="MSRP" {{ $elencoAttributi["MSRP"] }}>MSRP</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Materiale" {{ $elencoAttributi["Materiale"] }}>@lang('str.materiale')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Risoluzione" {{ $elencoAttributi["Risoluzione"] }}>@lang('str.risoluzione')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Formato" {{ $elencoAttributi["Formato"] }}>@lang('str.formato')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="MaxISO" {{ $elencoAttributi["MaxISO"] }}>@lang('str.maxISO')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="MaxISOExt" {{ $elencoAttributi["MaxISOExt"] }}>@lang('str.ISOext')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="AF"  {{ $elencoAttributi["AF"] }}>@lang('str.punti') AF</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="OSS" {{ $elencoAttributi["OSS"] }}>@lang('str.stabilizzazione')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Schermo" {{ $elencoAttributi["Schermo"] }}>@lang('str.schermo')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Mirino" {{ $elencoAttributi["Mirino"] }}>@lang('str.mirino')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Touch" {{ $elencoAttributi["Touch"] }}>Touch</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="MaxSS" {{ $elencoAttributi["MaxSS"] }}>@lang('str.massima') SS</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Flash" {{ $elencoAttributi["Flash"] }}>Flash @lang('str.integrato')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="FPS" {{ $elencoAttributi["FPS"] }}>@lang('str.raffica')</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="QHD" {{ $elencoAttributi["QHD"] }}>4K</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="FHD" {{ $elencoAttributi["FHD"] }}>Full HD</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="CIPA" {{ $elencoAttributi["CIPA"] }}>CIPA</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Peso" {{ $elencoAttributi["Peso"] }}>@lang('str.peso')</label>
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
        <table class="table table-striped table-hover table-responsive" style="width:100%">
            <thead>
                <tr>
                    @if ($elencoAttributi["ID"] !== "")
                    <th>ID</th>
                    @endif
                    @if ($elencoAttributi["Nome"] !== "")
                    <th>@lang('str.nome')</th>
                    @endif
                    @if ($elencoAttributi["Data"] !== "")
                    <th>@lang('str.data')</th>
                    @endif
                    @if ($elencoAttributi["MSRP"] !== "")
                    <th>MSRP</th>
                    @endif
                    @if ($elencoAttributi["Materiale"] !== "")
                    <th>@lang('str.materiale')</th>
                    @endif
                    @if ($elencoAttributi["Risoluzione"] !== "")
                    <th>@lang('str.risoluzione')</th>
                    @endif
                    @if ($elencoAttributi["Formato"] !== "")
                    <th>@lang('str.formato')</th>
                    @endif
                    @if ($elencoAttributi["MaxISO"] !== "")
                    <th>@lang('str.maxISO')</th>
                    @endif
                    @if ($elencoAttributi["MaxISOExt"] !== "")
                    <th>@lang('str.ISOext')</th>
                    @endif
                    @if ($elencoAttributi["OSS"] !== "")
                    <th>OSS</th>
                    @endif
                    @if ($elencoAttributi["AF"] !== "")
                    <th>AF</th>
                    @endif
                    @if ($elencoAttributi["Schermo"] !== "")
                    <th>@lang('str.schermo')</th>
                    @endif
                    @if ($elencoAttributi["Mirino"] !== "")
                    <th>@lang('str.mirino')</th>
                    @endif
                    @if ($elencoAttributi["Touch"] !== "")
                    <th>Touch</th>
                    @endif
                    @if ($elencoAttributi["MaxSS"] !== "")
                    <th>@lang('str.massima') SS</th>
                    @endif
                    @if ($elencoAttributi["Flash"] !== "")
                    <th>Flash</th>
                    @endif
                    @if ($elencoAttributi["FPS"] !== "")
                    <th>FPS</th>
                    @endif
                    @if ($elencoAttributi["QHD"] !== "")
                    <th>4K</th>
                    @endif
                    @if ($elencoAttributi["FHD"] !== "")
                    <th>FHD</th>
                    @endif
                    @if ($elencoAttributi["CIPA"] !== "")
                    <th>CIPA</th>
                    @endif
                    @if ($elencoAttributi["Peso"] !== "")
                    <th>@lang('str.peso')</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($elenco as $corpo)
                <tr onclick="window.location.href = '{{ route('modificaCorpo', ['corpo' => $corpo->ID, 'modifica' => ($modifica? "modifica" : "visualizza")]) }}';">
                    @if ($elencoAttributi["ID"] !== "")
                    <td>{{$corpo->ID}}</td>
                    @endif
                    @if ($elencoAttributi["Nome"] !== "")
                    <td>{{$corpo->Nome}}</td>
                    @endif
                    @if ($elencoAttributi["Data"] !== "")
                    <td>{{ $corpo->Data }}</td>
                    @endif
                    @if ($elencoAttributi["MSRP"] !== "")
                    <td>{{ $corpo->MSRP }}$</td>
                    @endif
                    @if ($elencoAttributi["Materiale"] != "")
                    <td>{{$corpo->Materiale}}</td>
                    @endif
                    @if ($elencoAttributi["Risoluzione"] != "")
                    <td>{{$corpo->Risoluzione}}</td>
                    @endif
                    @if ($elencoAttributi["Formato"] != "")
                    <td>{{$corpo->Formato}}</td>
                    @endif
                    @if ($elencoAttributi["MaxISO"] != "")
                    <td>{{$corpo->MaxISO}}</td>
                    @endif
                    @if ($elencoAttributi["MaxISOExt"] != "")
                    <td>{{$corpo->MaxISOExt}}</td>
                    @endif
                    @if ($elencoAttributi["OSS"] != "")
                        @if ($corpo->OSS == true)
                        <td><span class="label label-success">✔</span></td>
                        @else
                        <td><span class="label label-danger">✖</span></td>
                        @endif
                    @endif
                    @if ($elencoAttributi["AF"] != "")
                    <td>{{$corpo->AF}}</td>
                    @endif
                    @if ($elencoAttributi["Schermo"] != "")
                    <td>{{round($corpo->Schermo/3000000,1)}}</td>
                    @endif
                    @if ($elencoAttributi["Mirino"] != "")
                        @if ($corpo->Mirino >0)
                        <td>{{round($corpo->Mirino/3000000,1)}}</td>
                        @else
                        <td><span class="label label-danger">✖</span></td>
                        @endif
                    @endif
                    @if ($elencoAttributi["Touch"] != "")
                        @if ($corpo->Touch == true)
                        <td><span class="label label-success">✔</span></td>
                        @else
                        <td><span class="label label-danger">✖</span></td>
                        @endif
                    @endif
                    @if ($elencoAttributi["MaxSS"] != "")
                    <td>1/{{$corpo->MaxSS}}s</td>
                    @endif
                    @if ($elencoAttributi["Flash"] != "")
                        @if ($corpo->Flash == true)
                        <td><span class="label label-success">✔</span></td>
                        @else
                        <td><span class="label label-danger">✖</span></td>
                        @endif
                    @endif
                    @if ($elencoAttributi["FPS"] != "")
                    <td>{{$corpo->FPS}}</td>
                    @endif
                    @if ($elencoAttributi["QHD"] != "")
                        @if ($corpo->QHD >0)
                        <td>{{$corpo->QHD}}p</td>
                        @else
                        <td><span class="label label-danger">✖</span></td>
                        @endif
                    @endif
                    @if ($elencoAttributi["FHD"] != "")
                    <td>{{$corpo->FHD}}p</td>
                    @endif
                    @if ($elencoAttributi["CIPA"] != "")
                    <td>{{$corpo->CIPA}}</td>
                    @endif
                    @if ($elencoAttributi["Peso"] != "")
                    <td>{{$corpo->Peso}}g</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection