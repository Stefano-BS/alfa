@extends('layout.master')

@section('titolo','Alfa: Corpi macchina')

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
    <header>
        <h1>
            Catalogo Corpi
        </h1>
    </header>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="panel-group">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><a data-toggle="collapse" href="#collapse1"><span class="glyphicon glyphicon-filter"></span>  Seleziona Attributi</a></h3>
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
                                    <label class="checkbox-inline"><input type="checkbox" name="Nome" {{ $elencoAttributi["Nome"] }}>Nome</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Data" {{ $elencoAttributi["Data"] }}>Data</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="MSRP" {{ $elencoAttributi["MSRP"] }}>MSRP</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Materiale" {{ $elencoAttributi["Materiale"] }}>Materiale</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Risoluzione" {{ $elencoAttributi["Risoluzione"] }}>Risoluzione</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Formato" {{ $elencoAttributi["Formato"] }}>Formato</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="MaxISO" {{ $elencoAttributi["MaxISO"] }}>ISO Massimi</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="MaxISOExt" {{ $elencoAttributi["MaxISOExt"] }}>ISO Estesi</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="AF"  {{ $elencoAttributi["AF"] }}>Punti AF</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="OSS" {{ $elencoAttributi["OSS"] }}>Stabilizzazione</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Schermo" {{ $elencoAttributi["Schermo"] }}>Schermo</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Mirino" {{ $elencoAttributi["Mirino"] }}>Mirino</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Touch" {{ $elencoAttributi["Touch"] }}>Touch</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="MaxSS" {{ $elencoAttributi["MaxSS"] }}>Massima SS</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Flash" {{ $elencoAttributi["Flash"] }}>Flash integrato</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="FPS" {{ $elencoAttributi["FPS"] }}>Raffica</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="QHD" {{ $elencoAttributi["QHD"] }}>4K</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="FHD" {{ $elencoAttributi["FHD"] }}>Full HD</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="CIPA" {{ $elencoAttributi["CIPA"] }}>CIPA</label>
                                    <label class="checkbox-inline"><input type="checkbox" name="Peso" {{ $elencoAttributi["Peso"] }}>Peso</label>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer" style="background-color: rgba(0,0,0,0);">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12 col-md-offset-3">
                                        <input type="submit" name="select-submit" class="form-control btn btn-danger" value="Applica">
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
                    <th>Nome</th>
                    @endif
                    @if ($elencoAttributi["Data"] !== "")
                    <th>Data</th>
                    @endif
                    @if ($elencoAttributi["MSRP"] !== "")
                    <th>MSRP</th>
                    @endif
                    @if ($elencoAttributi["Materiale"] !== "")
                    <th>Materiale</th>
                    @endif
                    @if ($elencoAttributi["Risoluzione"] !== "")
                    <th>Risoluzione</th>
                    @endif
                    @if ($elencoAttributi["Formato"] !== "")
                    <th>Formato</th>
                    @endif
                    @if ($elencoAttributi["MaxISO"] !== "")
                    <th>ISO massimi</th>
                    @endif
                    @if ($elencoAttributi["MaxISOExt"] !== "")
                    <th>ISO Estesi</th>
                    @endif
                    @if ($elencoAttributi["OSS"] !== "")
                    <th>OSS</th>
                    @endif
                    @if ($elencoAttributi["AF"] !== "")
                    <th>AF</th>
                    @endif
                    @if ($elencoAttributi["Schermo"] !== "")
                    <th>Schermo</th>
                    @endif
                    @if ($elencoAttributi["Mirino"] !== "")
                    <th>Mirino</th>
                    @endif
                    @if ($elencoAttributi["Touch"] !== "")
                    <th>Touch</th>
                    @endif
                    @if ($elencoAttributi["MaxSS"] !== "")
                    <th>Massima SS</th>
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
                    <th>Peso</th>
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