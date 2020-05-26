@extends('layout.master')

@section('titolo',$obbiettivo->{'Nome Completo'})

@section('barraAccesso')
@if ($logged)
    <li><a href="{{ route('paginaUtente', ['utente' => $loggedName])}}"><span class="glyphicon glyphicon-user"></span>{{$loggedName}}</a></li>
    <li><a href="{{ route('uscita') }}"><span class="glyphicon glyphicon-log-out"></span>  Esci</a></li>
@else
    <li><a href="{{ route('accesso')  }}"><span class="glyphicon glyphicon-user"></span>Accedi</a></li>
@endif
@endsection

@section('corpo')
<script>
    document.getElementById('navObbiettivi').setAttribute('class', 'active');
</script>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-xs-12">
            <header>
                <h1><center style="margin-top: 1em;">{{ $obbiettivo->{'Nome Completo'} }}</center></h1>
            </header>
        </div>
    </div>
@if ($admin && $modifica == "modifica")
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <strong>Scheda Tecnica</strong>
            </div>
            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1 col-xs-12">
                    <form id="mod-obbiettivo" action="" method="post" class="form-horizontal">
                        @csrf
                        <div class="form-group row"><div class="col-sm-8">
                            <input type="hidden" name="id" id="id" class="form-control" value="{{$obbiettivo->ID}}"></div></div>
                        <div class="form-group row"><label for="nome" class="col-sm-4 col-form-label">Nome Completo: </label><div class="col-sm-8">
                            <input type="text" name="nome" id="nome" class="form-control" value="{{ $obbiettivo->{'Nome Completo'} }}"></div></div>
                        <div class="form-group row"><label for="marca" class="col-sm-4 col-form-label">Marca: </label><div class="col-sm-8">
                            <input type="text" name="marca" id="marca" class="form-control" value="{{ $obbiettivo->Marca}}"></div></div>
                        <div class="form-group row"><label for="rating" class="col-sm-4 col-form-label">Rating: </label><div class="col-sm-8">
                            <input type="text" name="rating" id="rating" class="form-control" value="{{ $obbiettivo->Rating}}"></div></div>
                        <div class="form-group row"><label for="lmin" class="col-sm-4 col-form-label">Lunghezza minima: </label><div class="col-sm-8">
                            <input type="text" name="lmin" id="lmin" class="form-control" value="{{ $obbiettivo->LMin}}"></div></div>
                        <div class="form-group row"><label for="lmax" class="col-sm-4 col-form-label">Lunghezza massima: </label><div class="col-sm-8">
                            <input type="text" name="lmax" id="lmax" class="form-control" value="{{ $obbiettivo->LMax}}"></div></div>
                        <div class="form-group row"><label for="f" class="col-sm-4 col-form-label">Apertura massima: </label><div class="col-sm-8">
                            <input type="text" name="f" id="f" class="form-control" value="{{ $obbiettivo->F}}"></div></div>
                        <div class="form-group row"><label for="flmax" class="col-sm-4 col-form-label">Apertura a massima focale: </label><div class="col-sm-8">
                            <input type="text" name="flmax" id="flmax" class="form-control" @if ($obbiettivo->FLMax !==0.0) value="{{ $obbiettivo->FLMax }}" @endif></div></div>
                        <div class="form-group row"><label for="tag" class="col-sm-4 col-form-label">Elenco TAG: </label><div class="col-sm-8">
                            <input type="text" name="tag" id="tag" class="form-control" value="{{$obbiettivo->TAG}}"></div></div>
                        <div class="form-group row"><label for="oss" class="col-sm-4 col-form-label">Stabilizzazione</label><div class="col-sm-8">
                            <input type="checkbox" name="oss" id="oss"@if($obbiettivo->OSS !==0)checked @endif></div></div>
                        <input type="submit" name="mod-obbiettivo" class="form-control btn btn-danger" value="Esegui Modifica"><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <strong>Scheda Tecnica</strong>
                </div>
                <div class="panel-body">
                    <label class="col-sm-12"><h4>Marca: <span class="label label-info">{{ $obbiettivo->Marca}}</span></h4></label>
                    <label class="col-sm-12"><h4>Rating: 
                    <?php for($i=0;$i<5;$i++){
                        echo ($i<strlen($obbiettivo->Rating)?'<span class="glyphicon glyphicon-star"></span>':'<span class="glyphicon glyphicon-star-empty"></span>');
                    }?>
                    </h4></label>
                    @if ($obbiettivo->LMin == $obbiettivo->LMax)
                        <label class="col-sm-12"><h4>Lunghezza focale: {{ $obbiettivo->LMin}}mm</h4></label>
                    @else
                        <label class="col-sm-12"><h4>Lunghezza minima: {{ $obbiettivo->LMin}}mm</h4></label>
                        <label class="col-sm-12"><h4>Lunghezza massima: {{ $obbiettivo->LMax}}mm</h4></label>
                    @endif
                    <label class="col-sm-12"><h4>Apertura massima: ƒ{{ $obbiettivo->F}}</h4></label>
                    @if ($obbiettivo->FLMax !==0.0)
                        <label class='col-sm-12'><h4>Apertura a massima focale: ƒ{{$obbiettivo->FLMax}}</h4></label>
                    @endif
                    @if ($obbiettivo->TAG !=="")
                        <label class="col-sm-12"><h4>Elenco TAG: {{$obbiettivo->TAG}}</h4></label>
                    @endif
                    <label class="col-sm-12"><h4>Stabilizzazione: @if($obbiettivo->OSS == 0) <span class="label label-danger">✖</span> @else <span class="label label-success">✔</span> @endif </h4></label>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <strong>Azioni</strong>
                </div>
                <div class="panel-body">
                    @if ($logged)
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <button {{$giaPos?"disabled":""}} onclick="window.location = '{{ route('aggiuntaPossessoObbiettivo', ['utente' => $loggedName, 'id' => $obbiettivo->ID])}}';" class="btn btn-success btn-large btn-block"><span class="glyphicon glyphicon-check"> </span>  Lo possiedo</button>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <button {{$giaDes?"disabled":""}} onclick="window.location = '{{ route('aggiuntaDesiderioObbiettivo', ['utente' => $loggedName, 'id' => $obbiettivo->ID])}}';" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-heart"> </span>  Lo desidero</button>
                        </div>
                    </div>
                    <hr>
                    @endif
                    <center>
                    <h4>Acquista</h4>
                    <a href="https://www.facebook.com/marketplace/search/?query=<?php echo str_replace(" ", "%20", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('home')}}/img/facebook.png" width="13%"></a>
                    <a href="https://www.subito.it/annunci-italia/vendita/usato/?q=<?php echo str_replace(" ", "+", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('home')}}/img/subito.png" width="13%"></a>
                    <a href="https://www.amazon.it/s?k=<?php echo str_replace(" ", "+", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('home')}}/img/amazon.png" width="13%"></a>
                    <a href="https://www.ebay.it/sch/i.html?_kw=<?php echo str_replace(" ", "+", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('home')}}/img/ebay.png" width="13%"></a>
                    <a href="https://www.e-infin.com/eu/search/<?php echo str_replace(" ", "%20", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('home')}}/img/infin.png" width="13%"></a>
                    <a href="https://www.eglobalcentral.co.it/product/<?php echo str_replace(" ", "%20", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('home')}}/img/eglobal.png" width="13%"></a>
                    <a href="https://www.fotoema.it/ricerca-un-prodotto.html?searchword=<?php echo str_replace(" ", "+", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('home')}}/img/fotoema.png" width="13%"></a>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <img src ='{{route('home')}}/img/{{$obbiettivo->ID}}.png' alt="Immagine" class='img-responsive'>
        </div>
    </div>
@endif 
</div>
@endsection