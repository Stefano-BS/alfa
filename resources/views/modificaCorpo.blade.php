@extends('layout.master')

@section('titolo',$corpo->Nome)

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
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-xs-12">
            <header>
                <h1 style="margin-top: 1em; text-align: center">{{$corpo->Nome}}</h1>
            </header>
        </div>
    </div>
@if (auth()->check() && auth()->user()->permessi && $modifica == "modifica")
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <strong>@lang('str.schedaTecnica')</strong>
            </div>
            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1 col-xs-12">
                    <form id="mod-obbiettivo" action="" method="post" class="form-horizontal">
                        @csrf
                        <div class="form-group row"><div class="col-sm-8">
                            <input type="hidden" name="id" id="id" class="form-control" value="{{$corpo->ID}}"></div></div>
                        <div class="form-group row"><label for="nome" class="col-sm-4 col-form-label">@lang('str.nome'): </label><div class="col-sm-8">
                            <input type="text" name="nome" id="nome" class="form-control" value="{{$corpo->Nome}}"></div></div>
                        <div class="form-group row"><label for="data" class="col-sm-4 col-form-label">@lang('str.data'): </label><div class="col-sm-8">
                            <input type="date" name="data" id="data" class="form-control" value="{{ $corpo->Data}}"></div></div>
                        <div class="form-group row"><label for="msrp" class="col-sm-4 col-form-label">MSRP: </label><div class="col-sm-8">
                            <input type="text" name="msrp" id="msrp" class="form-control" value="{{$corpo->MSRP}}"></div></div>
                        <div class="form-group row"><label for="materiale" class="col-sm-4 col-form-label"> @lang('str.materiale'): </label><div class="col-sm-8">
                            <input type="text" name="materiale" id="materiale" class="form-control" value="{{$corpo->Materiale}}"></div></div>
                        <div class="form-group row"><label for="risoluzione" class="col-sm-4 col-form-label">@lang('str.risoluzione'): </label><div class="col-sm-8">
                            <input type="text" name="risoluzione" id="risoluzione" class="form-control" value="{{$corpo->Risoluzione}}"></div></div>
                        <div class="form-group row"><label for="formato" class="col-sm-4 col-form-label">@lang('str.formato'): </label><div class="col-sm-8">
                            <input type="text" name="formato" id="formato" class="form-control" value="{{$corpo->Formato}}"></div></div>
                        <div class="form-group row"><label for="maxiso" class="col-sm-4 col-form-label">@lang('str.maxISO'): </label><div class="col-sm-8">
                            <input type="text" name="maxiso" id="maxiso" class="form-control" value="{{$corpo->MaxISO }}"></div></div>
                        <div class="form-group row"><label for="maxisoext" class="col-sm-4 col-form-label">@lang('str.ISOext'): </label><div class="col-sm-8">
                            <input type="text" name="maxisoext" id="maxisoext" class="form-control" value="{{$corpo->MaxISOExt}}"></div></div>
                        <div class="form-group row"><label for="oss" class="col-sm-4 col-form-label">@lang('str.stabilizzazione')</label><div class="col-sm-8">
                            <input type="checkbox" name="oss" id="oss"@if($corpo->OSS !==0)checked @endif></div></div>
                        <div class="form-group row"><label for="af" class="col-sm-4 col-form-label">AF: </label><div class="col-sm-8">
                            <input type="text" name="af" id="af" class="form-control" value="{{$corpo->AF}}"></div></div>
                        <div class="form-group row"><label for="schermo" class="col-sm-4 col-form-label">@lang('str.schermo'): </label><div class="col-sm-8">
                            <input type="text" name="schermo" id="schermo" class="form-control" value="{{$corpo->Schermo}}"></div></div>
                        <div class="form-group row"><label for="mirino" class="col-sm-4 col-form-label">@lang('str.mirino'): </label><div class="col-sm-8">
                            <input type="text" name="mirino" id="mirino" class="form-control" value="{{$corpo->Mirino}}"></div></div>
                        <div class="form-group row"><label for="touch" class="col-sm-4 col-form-label">Touch</label><div class="col-sm-8">
                            <input type="checkbox" name="touch" id="touch"@if($corpo->Touch !==0)checked @endif></div></div>
                        <div class="form-group row"><label for="maxss" class="col-sm-4 col-form-label">@lang('str.massima') SS: </label><div class="col-sm-8">
                            <input type="text" name="maxss" id="maxss" class="form-control" value="{{$corpo->MaxSS}}"></div></div>
                        <div class="form-group row"><label for="flash" class="col-sm-4 col-form-label">Flash</label><div class="col-sm-8">
                            <input type="checkbox" name="flash" id="flash"@if($corpo->Flash !==0)checked @endif></div></div>
                        <div class="form-group row"><label for="fps" class="col-sm-4 col-form-label">FPS: </label><div class="col-sm-8">
                            <input type="text" name="fps" id="fps" class="form-control" value="{{$corpo->FPS}}"></div></div>
                        <div class="form-group row"><label for="qhd" class="col-sm-4 col-form-label">4K: </label><div class="col-sm-8">
                            <input type="text" name="qhd" id="qhd" class="form-control" value="{{$corpo->QHD}}"></div></div>
                        <div class="form-group row"><label for="fhd" class="col-sm-4 col-form-label">FHD: </label><div class="col-sm-8">
                            <input type="text" name="fhd" id="fhd" class="form-control" value="{{$corpo->FHD}}"></div></div>
                        <div class="form-group row"><label for="cipa" class="col-sm-4 col-form-label">CIPA: </label><div class="col-sm-8">
                            <input type="text" name="cipa" id="cipa" class="form-control" value="{{$corpo->CIPA}}"></div></div>
                        <div class="form-group row"><label for="peso" class="col-sm-4 col-form-label">@lang('str.peso'): </label><div class="col-sm-8">
                            <input type="text" name="peso" id="peso" class="form-control" value="{{$corpo->Peso}}"></div></div>
                        <input type="submit" name="mod-obbiettivo" class="form-control btn btn-warning" value="@lang('str.eseguiModifica')"
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
                    <label class="col-sm-12"><h4>@lang('str.dataPresentazione'): {{$corpo->Data}}</h4></label>
                    <label class="col-sm-12"><h4>@lang('str.prezzoLancio') (MSRP): {{$corpo->MSRP}}$</h4></label>
                    <label class="col-sm-12"><h4>@lang('str.materiale'): {{$corpo->Materiale}}</h4></label>
                    <label class="col-sm-12"><h4>@lang('str.risoluzione'): {{$corpo->Risoluzione}}MP</h4></label>
                    <label class="col-sm-12"><h4>@lang('str.formatoSensore'): {{$corpo->Formato}}</h4></label>
                    <label class="col-sm-12"><h4>@lang('str.maxISO'): {{$corpo->MaxISO}}</h4></label>
                    <label class='col-sm-12'><h4>@lang('str.ISOext'): {{$corpo->MaxISOExt}}</h4></label>
                    <label class="col-sm-12"><h4>@lang('str.punti') AF: {{$corpo->AF}}</h4></label>
                    <label class="col-sm-12"><h4>@lang('str.punti') @lang('str.schermo'): {{$corpo->Schermo}}</h4></label>
                    <label class="col-sm-12"><h4>@lang('str.punti') @lang('str.mirino'): @if($corpo->Mirino > 0) {{$corpo->Mirino}} @else <span class="label label-danger">✖</span> @endif </h4></label>
                    <label class="col-sm-12"><h4>@lang('str.tempoOtturatore'): 1/{{$corpo->MaxSS}}s</h4></label>
                    <label class="col-sm-12"><h4>@lang('str.registra') Full HD: {{$corpo->FHD}}p</h4></label>
                    <label class="col-sm-12"><h4>@lang('str.registra') 4K: @if($corpo->QHD > 0) {{$corpo->QHD}}p @else <span class="label label-danger">✖</span> @endif </h4></label>
                    <label class="col-sm-12"><h4>@lang('str.stabilizzazione'): @if($corpo->OSS == 0) <span class="label label-danger">✖</span> @else <span class="label label-success">✔</span> @endif </h4></label>
                    <label class="col-sm-12"><h4>Touch: @if($corpo->Touch == 0) <span class="label label-danger">✖</span> @else <span class="label label-success">✔</span> @endif </h4></label>
                    <label class="col-sm-12"><h4>Flash @lang('str.integrato'): @if($corpo->Flash == 0) <span class="label label-danger">✖</span> @else <span class="label label-success">✔</span> @endif </h4></label>
                    <label class="col-sm-12"><h4>CIPA: {{$corpo->CIPA}}</h4></label>
                    <label class="col-sm-12"><h4>@lang('str.peso'): {{$corpo->Peso}}g</h4></label>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <strong>@lang('str.azioni')</strong>
                </div>
                <div class="panel-body">
                    @auth
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <button {{$giaPos?"disabled":""}} onclick="window.location = '{{ route('aggiuntaPossessoCorpo', ['utente' => auth()->user()->email, 'id' => $corpo->ID])}}';" class="btn btn-success btn-large btn-block"><span class="glyphicon glyphicon-check"> </span>  @lang('str.loPossiedo')</button>
                        </div>
                        <div class="col-md-0 col-xs-12"> </div>
                        <div class="col-md-6 col-xs-12">
                            <button {{$giaDes?"disabled":""}} onclick="window.location = '{{ route('aggiuntaDesiderioCorpo', ['utente' => auth()->user()->email, 'id' => $corpo->ID])}}';" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-heart"> </span>  @lang('str.loDesidero')</button>
                        </div>
                    </div>
                    <hr>
                    @endauth
                    <center>
                    <h4>@lang('str.acquista')</h4>
                    <a href="https://www.facebook.com/marketplace/search/?query=<?php echo str_replace([" ","α"], ["%20","a"], $corpo->Nome); ?>">
                        <img src="{{route('/')}}/img/facebook.png" width="13%"></a>
                    <a href="https://www.subito.it/annunci-italia/vendita/usato/?q=<?php echo str_replace([" ","α"], ["+","a"], $corpo->Nome); ?>">
                        <img src="{{route('/')}}/img/subito.png" width="13%"></a>
                    <a href="https://www.amazon.it/s?k=<?php echo str_replace([" ","α"], ["+","a"], $corpo->Nome); ?>">
                        <img src="{{route('/')}}/img/amazon.png" width="13%"></a>
                    <a href="https://www.ebay.it/sch/i.html?_kw=<?php echo str_replace([" ","α"], ["+","a"], $corpo->Nome); ?>">
                        <img src="{{route('/')}}/img/ebay.png" width="13%"></a>
                    <a href="https://www.e-infin.com/eu/search/<?php echo str_replace([" ","α"], ["%20","a"], $corpo->Nome); ?>">
                        <img src="{{route('/')}}/img/infin.png" width="13%"></a>
                    <a href="https://www.eglobalcentral.co.it/catalogsearch/result/?cat=&q=<?php echo str_replace([" ","α"], ["%+","a"], $corpo->Nome); ?>">
                        <img src="{{route('/')}}/img/eglobal.png" width="13%"></a>
                    <a href="https://www.fotoema.it/ricerca-un-prodotto.html?searchword=<?php echo str_replace([" ","α"], ["+","a"], $corpo->Nome); ?>">
                        <img src="{{route('/')}}/img/fotoema.png" width="13%"></a>
                    </center>
                </div>
            </div>
            <br>
            <img src ='{{route('/')}}/img/{{$corpo->Nome}}.png' alt="Immagine" class='img-responsive'>
        </div>
    </div>
@endif 
</div>
<script>
// VALIDAZIONE MODIFICA

function validazione() {
    var errore = false;
    var testo = "";
    var numero =  new RegExp("^([0-9]+(\.[0-9]+)?)$", "g");
    var intero =  new RegExp("^([0-9]+)$", "g");
    
    // Controllo campi nulli
    var campiNonNullabili = ["#nome", "#data", "#msrp", "#materiale", "#risoluzione", "#formato", "#maxiso", "#maxisoext", "#af", "#cipa", "#peso", "#qhd", "#fhd", "#maxss", "#fps", "#mirino", "#schermo"];
    for (i=0; i<campiNonNullabili.length; i++)
        if ($(campiNonNullabili[i])[0].value == "") {
            testo += "→ {{trans('str.ec1')}} (" + campiNonNullabili[i] + " {{trans('str.ec2')}})<BR>";
            errore = true;
            break;
        };
    
    var campiInteri = ["#msrp", "#risoluzione", "#maxiso", "#maxisoext", "#af", "#cipa", "#peso", "#qhd", "#fhd", "#maxss", "#fps", "#mirino", "#schermo"];
    for (i=0; i<campiInteri.length; i++)
        if (!$(campiInteri[i])[0].value.match(intero)) {
            testo += "→ {{trans('str.ec3')}} " + campiInteri[i] + " {{trans('str.ec4')}}<BR>";
            errore = true;
        };
    
    if (!errore) {
        var r = new XMLHttpRequest();
        r.open("GET", '{{route("corpoUnivoco")}}/' + $("#id")[0].value + '/' + $("#nome")[0].value, true);
        r.setRequestHeader("connection", "close");
        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {
                if (r.responseText <0 || isNaN(r.responseText)) {
                    document.getElementById("messaggio-errore").innerHTML = '<br><div id="messaggio-errore" class="alert alert-danger text-center">→ {{trans('str.eo11')}}</div>';
                } else if (r.responseText == 0) {
                    document.getElementById("mod-obbiettivo").submit();
                } else {
                    document.getElementById("messaggio-errore").innerHTML = '<br><div id="messaggio-errore" class="alert alert-danger text-center">→ {{trans('str.ec5')}}</div>';
                }
            }
        };
        r.send();
    } else {
        document.getElementById("messaggio-errore").innerHTML = '<br><div id="messaggio-errore" class="alert alert-danger text-center">' + testo + '</div>';
    }
}
</script>
@endsection