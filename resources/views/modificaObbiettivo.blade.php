@extends('layout.master')

@if ($modifica == "crea")
@section('titolo',trans('str.creaNuovoObbiettivo'))
@else
@section('titolo',$obbiettivo->{'Nome Completo'})
@endif

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
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-xs-12">
            <header>
                @if ($modifica == "crea")
                <h1 style="margin-top: 1em; text-align: center">@lang('str.creaNuovoObbiettivo')</h1>
                @else
                <h1 style="margin-top: 1em; text-align: center">{{ $obbiettivo->{'Nome Completo'} }}</h1>
                @endif
            </header>
        </div>
    </div>
@if (auth()->check() && auth()->user()->permessi && ($modifica == "modifica" || $modifica == "crea"))
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <strong>@lang('str.schedaTecnica')</strong>
            </div>
            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1 col-xs-12">
                    <form id="mod-obbiettivo" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class='form-group row'>
                            <input type="file" class="immagineProfilo" name="immagine" id="caricaImmObbiettivo" accept="image/x-png"/>
                            <label for="caricaImmObbiettivo">
                                <h5><span class='glyphicon glyphicon-upload'></span>  @lang('str.caricaFile')  </h5>
                            </label>
                        </div>
                        @if ($modifica == "modifica")
                        <div class="form-group row"><div class="col-sm-8">
                            <input type="hidden" name="id" id="id" class="form-control" value="{{$obbiettivo->ID}}"></div></div>
                        <div class="form-group row"><label for="nome" class="col-sm-4 col-form-label">@lang('str.nomeCompleto'): </label><div class="col-sm-8">
                            <input type="text" maxlength="50" name="nome" id="nome" class="form-control" value="{{ $obbiettivo->{'Nome Completo'} }}"></div></div>
                        <div class="form-group row"><label for="marca" class="col-sm-4 col-form-label">@lang('str.marca'): </label><div class="col-sm-8">
                            <input type="text" maxlength="10" name="marca" id="marca" class="form-control" value="{{ $obbiettivo->Marca}}"></div></div>
                        <div class="form-group row"><label for="rating" class="col-sm-4 col-form-label">@lang('str.rating'): </label><div class="col-sm-8">
                            <input type="text" maxlength="5" name="rating" id="rating" class="form-control" value="{{ $obbiettivo->Rating}}"></div></div>
                        <div class="form-group row"><label for="lmin" class="col-sm-4 col-form-label">@lang('str.lmin'): </label><div class="col-sm-8">
                            <input type="text" maxlength="12" name="lmin" id="lmin" class="form-control" value="{{ $obbiettivo->LMin}}"></div></div>
                        <div class="form-group row"><label for="lmax" class="col-sm-4 col-form-label">@lang('str.lmax'): </label><div class="col-sm-8">
                            <input type="text" maxlength="12" name="lmax" id="lmax" class="form-control" value="{{ $obbiettivo->LMax}}"></div></div>
                        <div class="form-group row"><label for="f" class="col-sm-4 col-form-label">@lang('str.maxf'): </label><div class="col-sm-8">
                            <input type="text" maxlength="12" name="f" id="f" class="form-control" value="{{ $obbiettivo->F}}"></div></div>
                        <div class="form-group row"><label for="flmax" class="col-sm-4 col-form-label">@lang('str.apertura') @lang('str.amaxf'): </label><div class="col-sm-8">
                            <input type="text" maxlength="12" name="flmax" id="flmax" class="form-control" @if ($obbiettivo->FLMax !==0.0) value="{{ $obbiettivo->FLMax }}" @endif></div></div>
                        <div class="form-group row"><label for="tag" class="col-sm-4 col-form-label">@lang('str.elencoTAG'): </label><div class="col-sm-8">
                            <input type="text" maxlength="20" name="tag" id="tag" class="form-control" value="{{$obbiettivo->TAG}}"></div></div>
                        <div class="form-group row"><label for="oss" class="col-sm-4 col-form-label">@lang('str.stabilizzazione')</label><div class="col-sm-8">
                            <input type="checkbox" name="oss" id="oss"@if($obbiettivo->OSS !==0)checked @endif></div></div>
                        <a data-toggle="modal" data-target="#confermaEliminazione" class="form-control btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>  @lang('str.rimuovi')</a><br><br>
                        @else
                        <div class="form-group row"><label for="nome" class="col-sm-4 col-form-label">@lang('str.nomeCompleto'): </label><div class="col-sm-8">
                            <input type="text" maxlength="50" name="nome" id="nome" class="form-control"></div></div>
                        <div class="form-group row"><label for="marca" class="col-sm-4 col-form-label">@lang('str.marca'): </label><div class="col-sm-8">
                            <input type="text" maxlength="10" name="marca" id="marca" class="form-control"></div></div>
                        <div class="form-group row"><label for="rating" class="col-sm-4 col-form-label">@lang('str.rating'): </label><div class="col-sm-8">
                            <input type="text" maxlength="5" name="rating" id="rating" class="form-control"></div></div>
                        <div class="form-group row"><label for="lmin" class="col-sm-4 col-form-label">@lang('str.lmin'): </label><div class="col-sm-8">
                            <input type="text" maxlength="12" name="lmin" id="lmin" class="form-control"></div></div>
                        <div class="form-group row"><label for="lmax" class="col-sm-4 col-form-label">@lang('str.lmax'): </label><div class="col-sm-8">
                            <input type="text" maxlength="12" name="lmax" id="lmax" class="form-control"></div></div>
                        <div class="form-group row"><label for="f" class="col-sm-4 col-form-label">@lang('str.maxf'): </label><div class="col-sm-8">
                            <input type="text" maxlength="12" name="f" id="f" class="form-control"></div></div>
                        <div class="form-group row"><label for="flmax" class="col-sm-4 col-form-label">@lang('str.apertura') @lang('str.amaxf'): </label><div class="col-sm-8">
                            <input type="text" maxlength="12" name="flmax" id="flmax" class="form-control"></div></div>
                        <div class="form-group row"><label for="tag" class="col-sm-4 col-form-label">@lang('str.elencoTAG'): </label><div class="col-sm-8">
                            <input type="text" maxlength="20" name="tag" id="tag" class="form-control"></div></div>
                        <div class="form-group row"><label for="oss" class="col-sm-4 col-form-label">@lang('str.stabilizzazione')</label><div class="col-sm-8">
                            <input type="checkbox" name="oss" id="oss"></div></div>
                        @endif
                        <input type="submit" name="mod-obbiettivo" class="form-control btn btn-warning" value="@lang('str.conferma')"
                            onclick="event.preventDefault(); validazione();"><br>
                    </form>
                    <p id="messaggio-errore"></p>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <strong>@lang('str.schedaTecnica')</strong>
                </div>
                <div class="panel-body">
                    <label class="col-sm-12"><h4>@lang('str.marca'): <span class="label label-info">{{ $obbiettivo->Marca}}</span></h4></label>
                    <label class="col-sm-12"><h4>@lang('str.rating'): 
                    <?php for($i=0;$i<5;$i++){
                        echo ($i<strlen($obbiettivo->Rating)?'<span class="glyphicon glyphicon-star"></span>':'<span class="glyphicon glyphicon-star-empty"></span>');
                    }?>
                    </h4></label>
                    @if ($obbiettivo->LMin == $obbiettivo->LMax)
                        <label class="col-sm-12"><h4>@lang('str.lunghezzaFocale'): {{ $obbiettivo->LMin}}mm</h4></label>
                    @else
                        <label class="col-sm-12"><h4>@lang('str.lmin'): {{ $obbiettivo->LMin}}mm</h4></label>
                        <label class="col-sm-12"><h4>@lang('str.lmax'): {{ $obbiettivo->LMax}}mm</h4></label>
                    @endif
                    <label class="col-sm-12"><h4>@lang('str.maxf'): ƒ{{ $obbiettivo->F}}</h4></label>
                    @if ($obbiettivo->FLMax !==0.0)
                        <label class='col-sm-12'><h4>@lang('str.apertura') @lang('str.amaxf'): ƒ{{$obbiettivo->FLMax}}</h4></label>
                    @endif
                    @if ($obbiettivo->TAG !=="")
                        <label class="col-sm-12"><h4>@lang('str.elencoTAG'): {{$obbiettivo->TAG}}</h4></label>
                    @endif
                    <label class="col-sm-12"><h4>@lang('str.stabilizzazione'): @if($obbiettivo->OSS == 0) <span class="label label-danger">✖</span> @else <span class="label label-success">✔</span> @endif </h4></label>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <strong>@lang('str.azioni')</strong>
                </div>
                <div class="panel-body">
                    @auth
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <button {{$giaPos?"disabled":""}} onclick="window.location = '{{ route('aggiuntaPossessoObbiettivo', ['utente' => auth()->user()->email, 'id' => $obbiettivo->ID])}}';" class="btn btn-success btn-large btn-block"><span class="glyphicon glyphicon-check"> </span>  @lang('str.loPossiedo')</button>
                        </div>
                        <div class="col-md-0 col-xs-12"> </div>
                        <div class="col-md-6 col-xs-12">
                            <button {{$giaDes?"disabled":""}} onclick="window.location = '{{ route('aggiuntaDesiderioObbiettivo', ['utente' => auth()->user()->email, 'id' => $obbiettivo->ID])}}';" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-heart"> </span>  @lang('str.loDesidero')</button>
                        </div>
                    </div>
                    <hr>
                    @endauth
                    <center>
                    <h4>@lang('str.acquista')</h4>
                    <a href="https://www.facebook.com/marketplace/search/?query=<?php echo str_replace(" ", "%20", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('/')}}/img/facebook.png" width="13%"></a>
                    <a href="https://www.subito.it/annunci-italia/vendita/usato/?q=<?php echo str_replace(" ", "+", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('/')}}/img/subito.png" width="13%"></a>
                    <a href="https://www.amazon.it/s?k=<?php echo str_replace(" ", "+", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('/')}}/img/amazon.png" width="13%"></a>
                    <a href="https://www.ebay.it/sch/i.html?_kw=<?php echo str_replace(" ", "+", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('/')}}/img/ebay.png" width="13%"></a>
                    <a href="https://www.e-infin.com/eu/search/<?php echo str_replace(" ", "%20", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('/')}}/img/infin.png" width="13%"></a>
                    <a href="https://www.eglobalcentral.co.it/catalogsearch/result/?cat=&q=<?php echo str_replace(" ", "+", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('/')}}/img/eglobal.png" width="13%"></a>
                    <a href="https://www.fotoema.it/ricerca-un-prodotto.html?searchword=<?php echo str_replace(" ", "+", $obbiettivo->{'Nome Completo'}); ?>">
                        <img src="{{route('/')}}/img/fotoema.png" width="13%"></a>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <img src ='{{route('/')}}/img/{{$obbiettivo->ID}}.png' alt="Immagine" class='img-responsive'>
        </div>
    </div>
@endif
</div>
@if (auth()->check() && auth()->user()->permessi && $modifica == "modifica")
<div id="confermaEliminazione" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title" id="nomeArticolo">{{ $obbiettivo->{'Nome Completo'} }}</h4>
            </div>
            <div class="modal-body text-center">
                <h4 class="modal-title">@lang('str.confermaEliminazione')</h4>
            </div>
            <div class="modal-footer">
                <div class="container">
                <div class="row">
                    <button type="button" class="btn btn-danger col-sm-5 col-xs-12" data-dismiss="modal" id='confermaFinale'
                    onclick="window.location.href = '{{ route('rimozioneObbiettivo', ['obbiettivo' => $obbiettivo->ID]) }}'">@lang('str.rimuovi')</button>
                    <div class="col-md-0 col-xs-12"> </div>
                    <button type="button" class="btn btn-default col-sm-5 col-xs-12 pull-right" data-dismiss="modal">@lang('str.annulla')</button>
                </div></div>
            </div>
        </div>
    </div>
</div>
@endif
<script>
// VALIDAZIONE MODIFICA

function validazione() {
    var errore = false;
    var testo = "";
    var numero =  new RegExp("^([0-9]+(\.[0-9]+)?)$", "g");
    
    if ($("#nome")[0].value == "") {
        testo += "→ {{trans('str.eo1')}}<BR>"
        errore = true;
    }
    if ($("#marca")[0].value == "") {
        testo += "→ {{trans('str.eo2')}}<BR>"
        errore = true;
    }
    if ($("#lmin")[0].value == "") {
        testo += "→ {{trans('str.eo3')}}<BR>"
        errore = true;
    } else if (!$("#lmin")[0].value.match(numero)) {
        testo += "→ {{trans('str.eo4')}}<BR>"
        errore = true;
    }
    if ($("#lmax")[0].value == "") {
        testo += "→ {{trans('str.eo5')}}<BR>"
        errore = true;
    } else if (!$("#lmax")[0].value.match(numero)) {
        testo += "→ {{trans('str.eo6')}}<BR>"
        errore = true;
    }
    if ($("#f")[0].value == "") {
        testo += "→ {{trans('str.eo7')}}<BR>"
        errore = true;
    } else if (!$("#f")[0].value.match(numero)) {
        testo += "→ {{trans('str.eo8')}}<BR>"
        errore = true;
    }
    if ($("#flmax")[0].value !== "" && !$("#flmax")[0].value.match(numero)) {
        testo += "→ {{trans('str.eo9')}}<BR>"
        errore = true;
    }
    if (!/^(\*{0,5})$/.test($("#rating")[0].value)) {
        testo += "→ {{trans('str.eo10')}}<BR>"
        errore = true;
    }
    
    
    if (!errore) {
        var r = new XMLHttpRequest();
        if (<?php if ($modifica == "crea") {echo "true";} else {echo "false";} ?>) {
            r.open("GET", '{{route("obbiettivoUnivoco")}}/10000/' + $("#nome")[0].value, true);
        } else {
            r.open("GET", '{{route("obbiettivoUnivoco")}}/' + $("#id")[0].value + '/' + $("#nome")[0].value, true);
        }
        r.setRequestHeader("connection", "close");
        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {
                if (r.responseText <0 || isNaN(r.responseText)) {
                    document.getElementById("messaggio-errore").innerHTML = '<br><div id="messaggio-errore" class="alert alert-danger text-center">→ {{trans('str.eo11')}}</div>';
                } else if (r.responseText == 0) {
                    document.getElementById("mod-obbiettivo").submit();
                } else {
                    document.getElementById("messaggio-errore").innerHTML = '<br><div id="messaggio-errore" class="alert alert-danger text-center">→ {{trans('str.eo12')}}</div>';
                }
            }
        };
        r.send();
        //r.send('{"nome" : "' + $("#nome")[0].value + '" }');
    } else {
        document.getElementById("messaggio-errore").innerHTML = '<br><div id="messaggio-errore" class="alert alert-danger text-center">' + testo + '</div>';
    }
}
</script>
@endsection