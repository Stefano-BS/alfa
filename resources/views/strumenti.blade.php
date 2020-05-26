@extends('layout.master')

@section('titolo','Alfa')

@section('barraAccesso')
@if ($logged)
    <li><a href="{{ route('paginaUtente', ['utente' => $loggedName])}}"><span class="glyphicon glyphicon-user"></span>  {{$loggedName}}</a></li>
    <li><a href="{{ route('uscita') }}"><span class="glyphicon glyphicon-log-out"></span>  Esci</a></li>
@else
    <li><a href="{{ route('accesso')  }}"><span class="glyphicon glyphicon-user"></span>  Accedi</a></li>
@endif
@endsection

@section('corpo')
<script>
    document.getElementById('navStrumenti').setAttribute('class', 'active');
</script>
<div class="container">
    <header>
        <h1 align="center">Strumenti utili</h1>
    </header>
</div>
<br>
<script>
DPI = 0;
erroreFormSensore = false;
function getDPI() {
    if (DPI>0) return;
    var div = document.createElement("div");
    div.style.height = "1in";
    div.style.width = "1in";
    div.style.top = "-100%";
    div.style.left = "-100%";
    div.style.position = "absolute";
    document.body.appendChild(div);
    var result =  div.offsetHeight;
    document.body.removeChild( div );
    DPI = result*1.3;//*window.devicePixelRatio;
}

function errore(messaggio, id) {
    erroreFormSensore = true;
    document.getElementById(id).parentNode.setAttribute("class","has-error");
    document.getElementById("messaggioErrore").innerHTML = messaggio;
    document.getElementById("messaggioErrore").setAttribute("class","alert alert-danger text-center");
}

function pFloat(value) {
    if(/^([0-9]+(\.[0-9]+)?)$/.test(value)) return Number(value);
    else return NaN;
}

function arrotonda(n, p) {
    return Math.round(n*Math.pow(10,p))/Math.pow(10,p);
}

function fpdc(){
    var cc = parseFloat(document.getElementById("cc").value);
    var fl = parseFloat(document.getElementById("fl").value);
    var fn = parseFloat(document.getElementById("fn").value);
    var dmf = parseFloat(document.getElementById("dmf").value);
    if (isNaN(cc) || isNaN(fl) || isNaN(fn) || isNaN(dmf)) return;
    if (cc==="" || fl==="" || fn==="" || dmf==="") return;
    if (cc<=0 || fl<=0 || fn<=0 || dmf<=0) return;
    var iper = fl*fl/(fn*cc)+fl/1000;
    var mfm = (iper-fl/1000)*dmf/(iper+dmf-2*fl/1000);
    var mfM = (dmf >= iper? "Infinito" : (iper-fl/1000)*dmf/(iper-dmf));
    document.getElementById("if").value = arrotonda(iper,3);
    document.getElementById("mfm").value = arrotonda(mfm,3);
    document.getElementById("mfM").value = (mfM === "Infinito"? mfM : arrotonda(mfM,3));
    document.getElementById("pdc").value = (mfM === "Infinito"? "Infinita" : arrotonda(mfM-mfm,3));
}

function fsd(){
    erroreFormSensore = false;
    var dim = (isNaN(pFloat(document.getElementById("dim").value))? eval(document.getElementById("dim").value) : parseFloat(document.getElementById("dim").value));
    var ratio = (isNaN(pFloat(document.getElementById("ratio").value))? eval(document.getElementById("ratio").value) : parseFloat(document.getElementById("ratio").value));
    var pix = parseFloat(document.getElementById("pix").value);
    var mp = parseFloat(document.getElementById("mp").value);
    var base = parseFloat(document.getElementById("base").value);
    var altezza = parseFloat(document.getElementById("alte").value);
    var diagonale, area, crop, diff;
    var hoCalcolato = false, hoCalcolatoDens = false;
    
    
    if (base>0 && altezza>0) { //Caso base 1
        diagonale = Math.sqrt(base*base+altezza*altezza);
        area = base*altezza;
        crop = 43.27/diagonale;
        var dimTemp = diagonale/25.4*Math.PI/2;
        if (isNaN(dim) || dim<=0 || (dimTemp<dim*1.05 && dimTemp>dim*0.95)) dim = dimTemp;
        else errore("Il valore fornito di dimensione non è compatibile con larghezza ed altezza (valore compatibile: " + arrotonda(dimTemp,2) + ")", "dim");
        var ratioTemp = base/altezza;
        if (isNaN(ratio)|| ratio <= 0 || (ratioTemp<ratio*1.05 && ratioTemp>ratio*0.95)) ratio = ratioTemp;
        else errore("Il valore fornito di formato non è compatibile con larghezza ed altezza (valore compatibile: " + arrotonda(ratioTemp,2) + ")","ratio");
        hoCalcolato = true;
    } else if (dim>0 && ratio>0) { //Caso base 2
        diagonale = dim*25.4/Math.PI*2;
        crop = 43.27/diagonale;
        var baseTemp = Math.sqrt(diagonale*diagonale/(1/(ratio*ratio)+1));
        if (isNaN(base) || base<=0 || (baseTemp<base*1.05 && baseTemp>base*0.95)) base = baseTemp;
        else errore("Il valore fornito di larghezza non è compatibile con dimensione e formato (valore compatibile: " + arrotonda(baseTemp,2) + ")","base");
        var altezzaTemp = Math.sqrt(diagonale*diagonale/(ratio*ratio+1));
        if (isNaN(altezza) || altezza<=0 || (altezzaTemp<altezza*1.05 && altezzaTemp>altezza*0.95)) altezza = altezzaTemp;
        else errore("Il valore fornito di altezza non è compatibile con dimensione e formato (valore compatibile: " + arrotonda(altezzaTemp,2) + ")","alte");
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
            else errore("Il valore fornito di dimensione del pixel non è compatibile con le dimensioni e il numero di mp forniti (valore compatibile: " + arrotonda(pixTemp,2) + ")","pix");
            diff = (1.4*pix)/(1.22*0.55);
            hoCalcolatoDens = true;
        } else if (!(pix==="" || isNaN(pix) || pix<=0)){
            var mpTemp = area/pix/pix;
            if (isNaN(mp) || mp<=0 || (mpTemp<mp*1.05 && mpTemp>mp*0.95)) mp = mpTemp;
            else errore("Il valore fornito di numero di pixel non è compatibile con le dimensioni degli stessi (valore compatibile: " + arrotonda(mpTemp,1) + ")","mp");
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
        document.getElementById("crop").value = arrotonda(crop,2);
        aggiornaCanvas(base, altezza);
    } else {
        aggiornaCanvas(0, 0);
    }
    if (hoCalcolatoDens) {
        document.getElementById("pix").value = arrotonda(pix,2);
        document.getElementById("mp").value = arrotonda(mp,1);
        document.getElementById("diff").value = arrotonda(diff,1);
    }
    
    if (!erroreFormSensore) {
        document.getElementById("messaggioErrore").innerHTML = "";
        document.getElementById("messaggioErrore").removeAttribute("class");
        var td = document.getElementById("rigaInputSensore").childNodes[1].childNodes;
        for (var nodo = 0; nodo<td.length; nodo++)
            if (td[nodo].nodeType === 1) td[nodo].removeAttribute("class");
    }
}

function resetSensore(){
    document.getElementById("dim").value = document.getElementById("ratio").value = document.getElementById("base").value = document.getElementById("alte").value = document.getElementById("diag").value = document.getElementById("area").value = document.getElementById("crop").value = document.getElementById("pix").value = document.getElementById("mp").value = "";
}

function resetPdC(){
    document.getElementById("pdc").value = document.getElementById("if").value = document.getElementById("cc").value = document.getElementById("fl").value = document.getElementById("fn").value = document.getElementById("dmf").value = document.getElementById("mfm").value = document.getElementById("mfM").value = "";
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
    
    getDPI();
    canvas.style.width = Math.round(base*DPI/25.4) + "px";
    canvas.style.height = Math.round(altezza*DPI/25.4) + "px";
    canvas.width = Math.round(base*DPI/25.4);
    canvas.height = Math.round(altezza*DPI/25.4);
    //ctx.fillStyle = "#2255aa";
    //ctx.fillRect(0,0,canvas.width, canvas.height);
    canvas.style.boxShadow =("0px 0px " + Math.sqrt(base*base+altezza*altezza)/3 + "px"); 
}
</script>
<div class="container">
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <strong>Calcolo della Profondità di Campo</strong>
            </div>
            <div class="panel-body">
                <form class="form-horizontal text-center">
                    <div class="table-responsive">
                        <table class="table table-responsive">
                            <thead>
                                <th>Circolo di confusione (μm)</th>
                                <th>Focale (mm)</th>
                                <th>Apertura</th>
                                <th>Distanza fuoco</th>
                                <th>A fuoco da</th>
                                <th>A fuoco fino</th>
                                <th>Iperfocale (m)</th>
                                <th>PdC (m)</th>
                            </thead>
                            <tbody>
                            <td><input type="text" class="form-control text-center" placeholder="8" id="cc" onchange="fpdc()"></td>
                            <td><input type="text" class="form-control text-center" id="fl" onchange="fpdc()"></td>
                            <td><input type="text" class="form-control text-center" id="fn" onchange="fpdc()"></td>
                            <td><input type="text" class="form-control text-center" id="dmf" onchange="fpdc()"></td>
                            <td><input type="text" readonly class="form-control text-center" id="mfm"></td>
                            <td><input type="text" readonly class="form-control text-center" id="mfM"></td>
                            <td><input type="text" readonly class="form-control text-center" id="if"></td>
                            <td><input type="text" readonly class="form-control text-center" id="pdc"></td>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col col-md-3 col-md-offset-9">
                            <button class="btn btn-info btn-large btn-block" onclick="resetPdC()">Ripulisci</button>
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
                <strong>Sensore Digitale</strong>
            </div>
            <div class="panel-body">
                <form class="form-horizontal text-center">
                    <div class="table-responsive">
                        <table class="table table-responsive">
                            <thead>
                                <th>Dimensione (standard)</th>
                                <th>Dimensione pixel (μm)</th>
                                <th>Milioni di pixel</th>
                                <th>Formato</th>
                                <th>Larghezza (mm)</th>
                                <th>Altezza (mm)</th>
                                <th>Diagonale (mm)</th>
                                <th>Area (mm²)</th>
                                <th>Fattore Crop</th>
                                <th>Diffrazione verde</th>
                            </thead>
                            <tbody id="rigaInputSensore">
                                <td><input type="text" class="form-control text-center" id="dim" onchange="fsd()"></td>
                                <td><input type="text" class="form-control text-center" id="pix" onchange="fsd()"></td>
                                <td><input type="text" class="form-control text-center" id="mp" onchange="fsd()"></td>
                                <td><input type="text" class="form-control text-center" id="ratio" onchange="fsd()"></td>
                                <td><input type="text" class="form-control text-center" id="base" onchange="fsd()"></td>
                                <td><input type="text" class="form-control text-center" id="alte" onchange="fsd()"></td>
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
                                <option value="FF">Pieno Formato</option>
                                <option value="PF">Leica Pro Format</option>
                                <option value="MF1">44x33</option>
                                <option value="MF2">53x40</option>
                            </select>
                        </div>
                        <div class="col col-md-3 col-md-offset-4">
                            <button class="btn btn-info btn-large btn-block" onclick="resetSensore()">Ripulisci</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="row text-center">
            <canvas id="sensore" width="0" height="0" style="background: url('./img/sensore.jpg'); background-size: cover;"></canvas>
        </div>
        <br>
    </div>
</div>
@endsection