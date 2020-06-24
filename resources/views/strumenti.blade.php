@extends('layout.master')

@section('titolo','Alfa')

@section('barraAccesso')
<?php
    require_once('barra.php');
    barra("");
?>
@endsection

@section('corpo')
<script>    document.getElementById('navStrumenti').setAttribute('class', 'active');
</script>
<div class="container">
    <header>
        <h1 align="center">@lang('str.strumentiUtili')</h1>
    </header>
</div>
<br>
<script>
erroreFormSensore = false;
var div = document.createElement("div");
div.style.height = "1in";
div.style.width = "1in";
div.style.top = "-100%";
div.style.left = "-100%";
div.style.position = "absolute";
document.body.appendChild(div);
DPI = div.offsetHeight*1.5;//*window.devicePixelRatio;
document.body.removeChild( div );

function errore(messaggio, id, areaErrori) {
    erroreFormSensore = true;
    document.getElementById(id).parentNode.setAttribute("class","has-error");
    var nuovoNodo = document.createElement("li");
    nuovoNodo.innerHTML = messaggio;
    document.getElementById(areaErrori).appendChild(nuovoNodo);
}

function azzeramentoErrori(div, riga) {
    erroreFormSensore = false;
    document.getElementById(div).innerHTML = "<ul></ul>";
    document.getElementById(div).setAttribute("class","alert alert-danger");
    var td = document.getElementById(riga).childNodes[1].childNodes;
    for (var nodo = 0; nodo<td.length; nodo++)
        if (td[nodo].nodeType === 1) td[nodo].removeAttribute("class");
}

function pFloat(value) {
    value = value.replace(",",".");
    if(/^([0-9]+(\.[0-9]+)?)$/.test(value)) return Number(value);
    else return NaN;
}

function arrotonda(n, p) {
    return Math.round(n*Math.pow(10,p))/Math.pow(10,p);
}

calcIper = function (fl, fn, cc) {
    return fl*fl/(fn*cc)+fl/1000;
};

calcMessaFuocoMinIper = function (iper, fl) {
    return (iper-fl/1000)*iper/(2*iper-2*fl/1000);
}
    
function fpdc(){
    azzeramentoErrori("messaggioErroreLente", "rigaInputLente");
    $("#grafico").addClass('hidden');
    //Dichiarazione Variabili del calcolo ed ottenimento dei valori
    var cc = pFloat(document.getElementById("cc").value);
    var fl = pFloat(document.getElementById("fl").value);
    var fn = pFloat(document.getElementById("fn").value);
    var dmf = pFloat(document.getElementById("dmf").value);
    
    if (isNaN(cc) && document.getElementById("cc").value !== "") errore(@lang('str.errore1'), "cc", "messaggioErroreLente");
    if (isNaN(fl) && document.getElementById("fl").value !== "") errore(@lang('str.errore2'), "fl", "messaggioErroreLente");
    if (isNaN(fn) && document.getElementById("fn").value !== "") errore(@lang('str.errore3'), "fn", "messaggioErroreLente");
    if (isNaN(dmf) && document.getElementById("dmf").value !== "") errore(@lang('str.errore4'), "dmf", "messaggioErroreLente");
    
    if (!erroreFormSensore) {
        document.getElementById("messaggioErroreLente").innerHTML = "";
        document.getElementById("messaggioErroreLente").removeAttribute("class");
    } else return;
    
    if (!isNaN(cc) && !isNaN(fl)) {
        grafico([calcIper(fl,1,cc),
            calcIper(fl,1.4,cc),
            calcIper(fl,2,cc),
            calcIper(fl,2.8,cc),
            calcIper(fl,4,cc),
            calcIper(fl,5.6,cc),
            calcIper(fl,8,cc),
            calcIper(fl,11,cc),
            calcIper(fl,16,cc),
            calcIper(fl,22,cc)],
            [calcMessaFuocoMinIper(calcIper(fl,1,cc),fl),
            calcMessaFuocoMinIper(calcIper(fl,1.4,cc),fl),
            calcMessaFuocoMinIper(calcIper(fl,2,cc),fl),
            calcMessaFuocoMinIper(calcIper(fl,2.8,cc),fl),
            calcMessaFuocoMinIper(calcIper(fl,4,cc),fl),
            calcMessaFuocoMinIper(calcIper(fl,5.6,cc),fl),
            calcMessaFuocoMinIper(calcIper(fl,8,cc),fl),
            calcMessaFuocoMinIper(calcIper(fl,11,cc),fl),
            calcMessaFuocoMinIper(calcIper(fl,16,cc),fl),
            calcMessaFuocoMinIper(calcIper(fl,22,cc),fl)]);
    }
    
    if (isNaN(cc) || isNaN(fl) || isNaN(fn) || isNaN(dmf)) return;
    
    var iper = calcIper(fl,fn,cc);
    var mfm = (iper-fl/1000)*dmf/(iper+dmf-2*fl/1000);
    var mfM = (dmf >= iper? "Infinito" : (iper-fl/1000)*dmf/(iper-dmf));
    
    document.getElementById("if").value = arrotonda(iper,3);
    document.getElementById("mfm").value = arrotonda(mfm,3);
    document.getElementById("mfM").value = (mfM === "Infinito"? mfM : arrotonda(mfM,3));
    document.getElementById("pdc").value = (mfM === "Infinito"? "Infinita" : arrotonda(mfM-mfm,3));
}

function fsd(){
    azzeramentoErrori("messaggioErrore", "rigaInputSensore");
    //Dichiarazione Variabili del calcolo ed ottenimento dei valori
    var diagonale, area, crop, diff;
    var hoCalcolato = false, hoCalcolatoDens = false;
    
    try {
        var dim = (isNaN(pFloat(document.getElementById("dim").value))? eval(document.getElementById("dim").value) : pFloat(document.getElementById("dim").value));
    } catch (e) {errore(@lang('str.errore5'), "dim","messaggioErrore");}
    try {
        var ratio = (isNaN(pFloat(document.getElementById("ratio").value))? eval(document.getElementById("ratio").value) : pFloat(document.getElementById("ratio").value));
    } catch (e) {errore(@lang('str.errore6'), "ratio","messaggioErrore");}
    var pix = pFloat(document.getElementById("pix").value);
    var mp = pFloat(document.getElementById("mp").value);
    var base = pFloat(document.getElementById("base").value);
    var altezza = pFloat(document.getElementById("alte").value);
    
    if (isNaN(pix) && document.getElementById("pix").value !== "") errore(@lang('str.errore7'), "pix","messaggioErrore");
    if (isNaN(mp) && document.getElementById("mp").value !== "") errore(@lang('str.errore8'), "mp","messaggioErrore");
    if (isNaN(base) && document.getElementById("base").value !== "") errore(@lang('str.errore9'), "base","messaggioErrore");
    if (isNaN(altezza) && document.getElementById("alte").value !== "") errore(@lang('str.errore10'), "alte","messaggioErrore");
    
   
    
    if (base>0 && altezza>0) { //Caso base 1
        diagonale = Math.sqrt(base*base+altezza*altezza);
        area = base*altezza;
        crop = 43.27/diagonale;
        var dimTemp = diagonale/25.4*Math.PI/2;
        if (isNaN(dim) || dim<=0 || (dimTemp<dim*1.05 && dimTemp>dim*0.95)) dim = dimTemp;
        else errore(@lang('str.errore11') + arrotonda(dimTemp,2) + ")", "dim","messaggioErrore");
        var ratioTemp = base/altezza;
        if (isNaN(ratio)|| ratio <= 0 || (ratioTemp<ratio*1.05 && ratioTemp>ratio*0.95)) ratio = ratioTemp;
        else errore(@lang('str.errore12') + arrotonda(ratioTemp,2) + ")","ratio","messaggioErrore");
        hoCalcolato = true;
    } else if (dim>0 && ratio>0) { //Caso base 2
        diagonale = dim*25.4/Math.PI*2;
        crop = 43.27/diagonale;
        var baseTemp = Math.sqrt(diagonale*diagonale/(1/(ratio*ratio)+1));
        if (isNaN(base) || base<=0 || (baseTemp<base*1.05 && baseTemp>base*0.95)) base = baseTemp;
        else errore(@lang('str.errore13') + arrotonda(baseTemp,2) + ")","base","messaggioErrore");
        var altezzaTemp = Math.sqrt(diagonale*diagonale/(ratio*ratio+1));
        if (isNaN(altezza) || altezza<=0 || (altezzaTemp<altezza*1.05 && altezzaTemp>altezza*0.95)) altezza = altezzaTemp;
        else errore(@lang('str.errore14') + arrotonda(altezzaTemp,2) + ")","alte","messaggioErrore");
        area = base*altezza;
        hoCalcolato = true;
    } else if (base>0 && ratio>0) { //Casi derivati
        var altezzaTemp = base/ratio;
        if (isNaN(altezza) || altezza<=0 || (altezzaTemp<altezza*1.05 && altezzaTemp>altezza*0.95)) {
            document.getElementById("alte").value = arrotonda(altezzaTemp,2);
            fsd();
            return;
        }
    } else if (altezza>0 && ratio>0) {
        var baseTemp = altezza*ratio;
        if (isNaN(base) || base<=0 || (baseTemp<base*1.05 && baseTemp>base*0.95)) {
            document.getElementById("base").value = arrotonda(baseTemp,2);
            fsd();
            return;
        }
    }
    
    if (hoCalcolato) {
        if (!(mp==="" || isNaN(mp) || mp<=0)) {
            var pixTemp = base/Math.sqrt(mp*1000000*ratio)*1000;
            if (isNaN(pix) || pix<=0 || (pixTemp<pix*1.05 && pixTemp>pix*0.95)) pix = pixTemp;
            else errore(@lang('str.errore15') + arrotonda(pixTemp,2) + ")","pix","messaggioErrore");
            diff = (1.4*pix)/(1.22*0.55);
            hoCalcolatoDens = true;
        } else if (!(pix==="" || isNaN(pix) || pix<=0)){
            var mpTemp = area/pix/pix;
            if (isNaN(mp) || mp<=0 || (mpTemp<mp*1.05 && mpTemp>mp*0.95)) mp = mpTemp;
            else errore(@lang('str.errore16') + arrotonda(mpTemp,1) + ")","mp","messaggioErrore");
            diff = (1.4*pix)/(1.22*0.55);
            hoCalcolatoDens = true;
        }
    }
    
    if (hoCalcolato) {
        document.getElementById("dim").value = arrotonda(dim,2);
        document.getElementById("ratio").value = arrotonda(ratio,1);
        document.getElementById("base").value = arrotonda(base,2);
        document.getElementById("alte").value = arrotonda(altezza,2);
        document.getElementById("diag").value = arrotonda(diagonale,2);
        document.getElementById("area").value = arrotonda(area,1);
        document.getElementById("crop").value = arrotonda(crop,2) + "⨯";
        aggiornaCanvas(base, altezza);
    } else {
        aggiornaCanvas(0, 0);
    }
    if (hoCalcolatoDens) {
        document.getElementById("pix").value = arrotonda(pix,2);
        document.getElementById("mp").value = arrotonda(mp,1);
        document.getElementById("diff").value = "ƒ" + arrotonda(diff,1);
    }
    
    if (!erroreFormSensore) {
        document.getElementById("messaggioErrore").innerHTML = "";
        document.getElementById("messaggioErrore").removeAttribute("class");
    }
}

function resetSensore(){
    document.getElementById("dim").value = document.getElementById("ratio").value = document.getElementById("base").value = document.getElementById("alte").value = document.getElementById("diag").value = document.getElementById("area").value = document.getElementById("crop").value = document.getElementById("pix").value = document.getElementById("mp").value = "";
    fsd();
}

function resetPdC(){
    document.getElementById("pdc").value = document.getElementById("if").value = document.getElementById("cc").value = document.getElementById("fl").value = document.getElementById("fn").value = document.getElementById("dmf").value = document.getElementById("mfm").value = document.getElementById("mfM").value = "";
    fpdc();
}

function applicaPreset() {
    document.getElementById("pix").value = document.getElementById("dim").value = document.getElementById("ratio").value = document.getElementById("base").value = document.getElementById("alte").value = document.getElementById("diag").value = document.getElementById("area").value = document.getElementById("crop").value = "";
    var preset = document.getElementById("preset").selectedIndex;
    var dim, ratio;
    if (preset === 0) {return;}
    if (preset === 1) {dim = "1/4"; ratio = "4/3";}
    if (preset === 2) {dim = "1/3"; ratio = "4/3";}
    if (preset === 3) {dim = "1/2.55"; ratio = "4/3";}
    if (preset === 4) {dim = "1/2.3"; ratio = "4/3";}
    if (preset === 5) {dim = "1/2"; ratio = "4/3";}
    if (preset === 6) {dim = "1/1.7"; ratio = "4/3";}
    if (preset === 7) {dim = "1/1.33"; ratio = "4/3";}
    if (preset === 8) {dim = "1"; ratio = "3/2";}
    if (preset === 9) {dim = "4/3"; ratio = "4/3";}
    if (preset === 10) {dim = "5/3"; ratio = "3/2";}
    if (preset === 11) {dim = "7/4"; ratio = "3/2";}
    if (preset === 12) {dim = "8/3"; ratio = "3/2";}
    if (preset === 13) {dim = "10/3"; ratio = "3/2";}
    if (preset === 14) {dim = "17/5"; ratio = "4/3";}
    if (preset === 15) {dim = "33/8"; ratio = "4/3";}
    document.getElementById("dim").value = dim;
    document.getElementById("ratio").value = ratio;
    fsd();
}

function aggiornaCanvas(base, altezza) {
    var canvas = document.getElementById('sensore');
    var ctx = canvas.getContext('2d');
    
    if (base>0) {
        $("#spaziatura").removeClass('hidden'); 
        $("#sensore").removeClass('hidden');
    }
    
    $("#sensore").animate({
        width: Math.round(base*DPI/25.4),
        height: Math.round(altezza*DPI/25.4)
        }, "slow", function(){
            canvas.style.boxShadow = "0px 0px " + Math.sqrt(base*base+altezza*altezza)/3 + "px";
            if (!base>0) {
                $("#spaziatura").addClass('hidden');
                $("#sensore").addClass('hidden');
            }
        });
    
    /*canvas.style.width = Math.round(base*DPI/25.4) + "px";
    canvas.style.height = Math.round(altezza*DPI/25.4) + "px";
    canvas.width = Math.round(base*DPI/25.4);
    canvas.height = Math.round(altezza*DPI/25.4);*/
    //ctx.fillStyle = "#2255aa";
    //ctx.fillRect(0,0,canvas.width, canvas.height);
}

function applicaObbiettivo() {
    document.getElementById("fl").value = document.getElementById("fn").value = "";
    var preset = document.getElementById("obbiettivo").selectedIndex;
    if (preset === 0) {return;}
    document.getElementById("fl").value = $('#obbiettivo option:selected').attr('lmin');
    document.getElementById("fn").value = $('#obbiettivo option:selected').attr('f');
    fpdc();
}

function grafico(iperfocali, aFuocoDa){
    $("#grafico").removeClass('hidden');
    var diaframmi = [1, 1.4, 2, 2.8, 4, 5.6, 8, 11, 16, 22];
                            
    var ctx = document.getElementById("grafico");
    
    myChart = new Chart(ctx, {
        type: 'line',
        options: {
            title: {
                display: true,
                text: "@lang('str.if')",
                fontSize: 20,
            },
            legend: {
                display: true,
                position: 'top',
            },
        },
        data: {
            labels: diaframmi,
            datasets: [
                {label: "@lang('str.if')", borderColor: "#fffa99", backgroundColor: 'rgba(220,210,40,0.3)', data: iperfocali},
                {label: "@lang('str.aFuocoDa')", borderColor: "#ffaa33", backgroundColor: 'rgba(220,100,0,0.3)', data: aFuocoDa},
            ]
        }
    });
}
</script>
<div class="container">
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <strong>@lang('str.calcoloPDC')</strong>
            </div>
            <div class="panel-body">
                <form class="form-horizontal text-center" onchange="fpdc()" action="">
                    <div class="table-responsive">
                        <table class="table table-responsive">
                            <thead>
                                <th>@lang('str.circolo') (μm)</th>
                                <th>@lang('str.focale') (mm)</th>
                                <th>@lang('str.apertura')</th>
                                <th>@lang('str.distMF')</th>
                                <th>@lang('str.MFda')</th>
                                <th>@lang('str.MFa')</th>
                                <th>@lang('str.if') (m)</th>
                                <th>@lang('str.pdc') (m)</th>
                            </thead>
                            <tbody id="rigaInputLente">
                            <td><input type="text" class="form-control text-center" id="cc"></td>
                            <td><input type="text" class="form-control text-center" id="fl"></td>
                            <td><input type="text" class="form-control text-center" id="fn"></td>
                            <td><input type="text" class="form-control text-center" id="dmf"></td>
                            <td><input type="text" readonly class="form-control text-center" id="mfm"></td>
                            <td><input type="text" readonly class="form-control text-center" id="mfM"></td>
                            <td><input type="text" readonly class="form-control text-center" id="if"></td>
                            <td><input type="text" readonly class="form-control text-center" id="pdc"></td>
                            </tbody>
                        </table>
                    </div>
                    <p id="messaggioErroreLente"></p>
                    <div class="row">
                        <div class="col col-md-5">
                            <select class="form-control" name="obbiettivo" id="obbiettivo" onchange="applicaObbiettivo()">
                                <option value="default" selected></option>
                                @foreach ($obbiettivi as $obbiettivo)
                                <option lmin="{{$obbiettivo->LMin}}" f="{{$obbiettivo->F}}">{{ $obbiettivo->{'Nome Completo'} }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-0 col-xs-12"> </div>
                        <div class="col col-md-3 col-md-offset-4">
                            <button class="btn btn-info btn-large btn-block" onclick="resetPdC()">@lang('str.ripulisci')</button>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row" id="graficoContainer">
                            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12" id="graficoContainer">
                                <canvas id="grafico" class="hidden"></canvas>
                                <script src="{{ route("/") }}/js/chart.min.js"></script>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <strong>@lang('str.sensoreDigitale')</strong>
            </div>
            <div class="panel-body">
                <form class="form-horizontal text-center" onchange="fsd()" action="">
                    <div class="table-responsive">
                        <table class="table table-responsive">
                            <thead>
                                <th>@lang('str.dimensione')</th>
                                <th>@lang('str.dimensionePixel') (μm)</th>
                                <th>@lang('str.mp')</th>
                                <th>@lang('str.formato')</th>
                                <th>@lang('str.larghezza') (mm)</th>
                                <th>@lang('str.altezza') (mm)</th>
                                <th>@lang('str.diagonale') (mm)</th>
                                <th>Area (mm²)</th>
                                <th>@lang('str.fattoreCrop')</th>
                                <th>@lang('str.diffrazioneVerde')</th>
                            </thead>
                            <tbody id="rigaInputSensore">
                                <td><input type="text" class="form-control text-center" id="dim"></td>
                                <td><input type="text" class="form-control text-center" id="pix"></td>
                                <td><input type="text" class="form-control text-center" id="mp"></td>
                                <td><input type="text" class="form-control text-center" id="ratio"></td>
                                <td><input type="text" class="form-control text-center" id="base"></td>
                                <td><input type="text" class="form-control text-center" id="alte"></td>
                                <td><input type="text" readonly class="form-control text-center" id="diag"></td>
                                <td><input type="text" readonly class="form-control text-center" id="area"></td>
                                <td><input type="text" readonly class="form-control text-center" id="crop"></td>
                                <td><input type="text" readonly class="form-control text-center" id="diff"></td>
                            </tbody>
                        </table>
                    </div>
                    <p id="messaggioErrore"></p>
                    <div class="row">
                        <div class="col col-md-5">
                            <select class="form-control" name="preset" id="preset" onchange="applicaPreset()">
                                <option value="default" selected></option>
                                <option value="1/4">1/4"</option>
                                <option value="1/3">1/3"</option>
                                <option value="1/2.55">1/2.55"</option>
                                <option value="1/2.3">1/2.3"</option>
                                <option value="1/2">1/2"</option>
                                <option value="1/1.7">1/1.7"</option>
                                <option value="1/1.33">1/1.33"</option>
                                <option value="1">1"</option>
                                <option value="micro4/3">micro4/3</option>
                                <option value="Canon">Canon</option>
                                <option value="APS">APS-C</option>
                                <option value="FF">@lang('str.ff')</option>
                                <option value="PF">Leica Pro Format</option>
                                <option value="MF1">44x33</option>
                                <option value="MF2">53x40</option>
                            </select>
                        </div>
                        <div class="col-md-0 col-xs-12"> </div>
                        <div class="col col-md-3 col-md-offset-4">
                            <button class="btn btn-info btn-large btn-block" onclick="resetSensore()">@lang('str.ripulisci')</button>
                        </div>
                    </div>
                    <div class="row text-center">
                        <br id="spaziatura" class="hidden">
                        <canvas id="sensore" width="0" height="0" class="hidden" style="background: url('./img/sensore.jpg'); background-size: cover;"></canvas>
                    </div>
                </form>
            </div>
        </div>
        <br>
    </div>
</div>
<script>
$("#grafico").width($("#graficoContainer").width());
$("#grafico").height($("#graficoContainer").width());
</script>
@endsection