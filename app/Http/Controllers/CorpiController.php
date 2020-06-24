<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DB;
use App\Corpo;

class CorpiController extends Controller {
    
    public function tabella(Request $request, $modifica = false){
        $modifica = $modifica == "modifica";
        $db = new DB();
        $elencoAttributi = ['ID' => "",'Nome' => "checked",'Data' => "checked",'MSRP' => "checked",'Materiale' => "checked",'Risoluzione' => "",'Formato' => "",'MaxISO' => "checked",'MaxISOExt' => "",'OSS' => "checked",'AF' => "checked",'Schermo' => "",'Mirino' => "checked",'Touch' => "",'MaxSS' => "",'Flash' => "",'FPS' => "checked",'QHD' => "checked",'FHD' => "checked",'CIPA' => "checked",'Peso' => ""];
        
        if ($request->method() == "POST") {
            $elencoAttributi = ['ID' => "",'Nome' => "",'Data' => "",'MSRP' => "",'Materiale' => "",'Risoluzione' => "",'Formato' => "",'MaxISO' => "",'MaxISOExt' => "",'OSS' => "",'AF' => "",'Schermo' => "",'Mirino' => "",'Touch' => "",'MaxSS' => "",'Flash' => "",'FPS' => "",'QHD' => "",'FHD' => "",'CIPA' => "",'Peso' => ""];
            if ($request->input("ID")) {$elencoAttributi["ID"] = "checked";}
            if ($request->input("Nome")) {$elencoAttributi["Nome"] = "checked";}
            if ($request->input("Data")) {$elencoAttributi["Data"] = "checked";}
            if ($request->input("MSRP")) {$elencoAttributi["MSRP"] = "checked";}
            if ($request->input("Peso")) {$elencoAttributi["Peso"] = "checked";}
            if ($request->input("FPS")) {$elencoAttributi["FPS"] = "checked";}
            if ($request->input("Formato")) {$elencoAttributi["Formato"] = "checked";}
            if ($request->input("Risoluzione")) {$elencoAttributi["Risoluzione"] = "checked";}
            if ($request->input("Schermo")) {$elencoAttributi["Schermo"] = "checked";}
            if ($request->input("OSS")) {$elencoAttributi["OSS"] = "checked";}
            if ($request->input("Mirino")) {$elencoAttributi["Mirino"] = "checked";}
            if ($request->input("Flash")) {$elencoAttributi["Flash"] = "checked";}
            if ($request->input("QHD")) {$elencoAttributi["QHD"] = "checked";}
            if ($request->input("FHD")) {$elencoAttributi["FHD"] = "checked";}
            if ($request->input("CIPA")) {$elencoAttributi["CIPA"] = "checked";}
            if ($request->input("Materiale")) {$elencoAttributi["Materiale"] = "checked";}
            if ($request->input("MaxISO")) {$elencoAttributi["MaxISO"] = "checked";}
            if ($request->input("MaxISOExt")) {$elencoAttributi["MaxISOExt"] = "checked";}
            if ($request->input("AF")) {$elencoAttributi["AF"] = "checked";}
            if ($request->input("Touch")) {$elencoAttributi["Touch"] = "checked";}
            if ($request->input("MaxSS")) {$elencoAttributi["MaxSS"] = "checked";}
        }
        
        $elenco = $db->elencoCorpi();
        return view('corpi')->with('modifica',$modifica)->with('elenco', $elenco)->with('elencoAttributi', $elencoAttributi);
    }
    
    public function pagina($corpo, $modifica) {
        $giaDes = false; $giaPos = false;
        $corpo = Corpo::find($corpo);
        if (empty($corpo)) {
            return Redirect::back();
        }
        if (auth()->check()) {
            $db = new DB();
            $desideri = $db->elencoDesideriCorpo(auth()->user()->id);
            foreach ($desideri as $desiderio) {
                if ($desiderio->ID == $corpo->ID) {$giaDes = true; break;}
            }
            $possessi = $db->elencoPossessiCorpo(auth()->user()->id);
            foreach ($possessi as $possesso) {
                if ($possesso->ID == $corpo->ID) {$giaPos = true; break;}
            }
        }
        return view('modificaCorpo')->with('corpo',$corpo)->with('modifica', $modifica)
                ->with('giaDes',$giaDes)->with('giaPos',$giaPos);
    }
    
    public function eseguiModifica(Request $request) {
        if(auth()->check() && auth()->user()->permessi) {
            $db = new DB();
            $db->modificaCorpo($request->input("id"), ['Nome' => $request->input('nome'),
                'Data' => $request->input('data'),'MSRP' => $request->input('msrp'),'Materiale' => $request->input('materiale'),
                'Risoluzione' => (float)$request->input('risoluzione'),'Formato' => $request->input('formato'),
                'MaxISO' => $request->input('maxiso'),'MaxISOExt' => $request->input('maxisoext'),
                'OSS' => (bool)$request->input('oss'),'AF' => $request->input('af'),'Schermo' => $request->input('schermo'),
                'Mirino' => $request->input('mirino'),'Touch' => (bool)$request->input('touch'),'MaxSS' => $request->input('maxss'),
                'Flash' => (bool)$request->input('flash'),'FPS' => $request->input('fps'),'QHD' => $request->input('qhd'),
                'FHD' => $request->input('fhd'),'CIPA' => $request->input('cipa'),'Peso' => $request->input('peso')]);
            return Redirect::to(route('corpi', ["modifica" => "modifica"]));
        } else {
            return Redirect::to(route('home'));
        }
    }
    
    public function univoco($id, $corpo) {
        $risposta = count(Corpo::where([
            ['Nome', $corpo],
            ['ID', "!=", $id]])->get());
        return response($risposta);
    }
}