<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DB;
use App\Obbiettivo;

class ObbiettiviController extends Controller {
    
    public function tabella(Request $request, $modifica = false){
        $modifica = $modifica == "modifica";
        $db = new DB();
        $listaMarche = [trans('str.tutte'),"7Artisans","Dorr","Kamlan","Laowa","Lensbaby","Meike","Mitakon","Neewer","Samyang","Sigma","Sony","SLR Magic","Tamron","Yasuhara","Yongnuo","Zeiss","Zonlai"];
        
        if ($request->method() == "GET") {
            $focaliSelezionate = [4, 350];
            $apertureSelezionate = [7.4, 8];
            $marcaSelezionata = trans('str.tutte');
            $elencoAttributi = ["Nome" => "", "ID" => "", "Marca" => "checked", "Rating" => "checked", "LMin" => "checked", "LMax" => "checked", "F" => "checked", "FLMax" => "checked", "TAG" => "checked", "OSS" => "checked"];
        } elseif ($request->method() == "POST") {
            $elencoAttributi = ["Nome" => "", "ID" => "", "Marca" => "", "Rating" => "", "LMin" => "", "LMax" => "", "F" => "", "FLMax" => "", "TAG" => "", "OSS" => ""];
            if ($request->input("ID")) {$elencoAttributi["ID"] = "checked";}
            if ($request->input("Nome")) {$elencoAttributi["Nome"] = "checked";}
            if ($request->input("Rating")) {$elencoAttributi["Rating"] = "checked";}
            if ($request->input("Marca")) {$elencoAttributi["Marca"] = "checked";}
            if ($request->input("LMin")) {$elencoAttributi["LMin"] = "checked";}
            if ($request->input("LMax")) {$elencoAttributi["LMax"] = "checked";}
            if ($request->input("F")) {$elencoAttributi["F"] = "checked";}
            if ($request->input("FLMax")) {$elencoAttributi["FLMax"] = "checked";}
            if ($request->input("TAG")) {$elencoAttributi["TAG"] = "checked";}
            if ($request->input("OSS")) {$elencoAttributi["OSS"] = "checked";}
            $marcaSelezionata = $request->input("sel-marca");
            $focaliSelezionate = str_replace(" mm","",str_replace("Focale: ","",$request->input("focal-range")));
            $apertureSelezionate = str_replace("- f","",str_replace("Apertura: ","",$request->input("aperture-range")));
            preg_match_all("/[0-9]+/", $focaliSelezionate, $focaliSelezionate,PREG_OFFSET_CAPTURE);
            preg_match_all("/[0-9](\.[0-9])*/", $apertureSelezionate, $apertureSelezionate,PREG_OFFSET_CAPTURE);
            $focaliSelezionate = [$focaliSelezionate[0][0][0], $focaliSelezionate[0][1][0]];
            $apertureSelezionate = [$apertureSelezionate[0][0][0],$apertureSelezionate[0][1][0]];
        }
        
        $elenco = $db->elencoObbiettivi($marcaSelezionata, $focaliSelezionate, $apertureSelezionate);
        return view('obbiettivi')->with('modifica', $modifica)
            ->with('elencoAttributi', $elencoAttributi)->with('marcaSelezionata', $marcaSelezionata)->with('listaMarche',$listaMarche)
            ->with('focaliSelezionate',$focaliSelezionate)->with('apertureSelezionate',$apertureSelezionate)->with('elenco',$elenco);
    }
    
    public function pagina($obbiettivo, $modifica) {
        $giaDes = false; $giaPos = false;
        $obbiettivo = Obbiettivo::find($obbiettivo);
        if (empty($obbiettivo)) {
            return Redirect::back();
        }
        if (auth()->check()) {
            $db = new DB();
            $desideri = $db->elencoDesideriObbiettivo(auth()->user()->id);
            foreach ($desideri as $desiderio) {
                if ($desiderio->ID == $obbiettivo->ID) {$giaDes = true; break;}
            }
            $possessi = $db->elencoPossessiObbiettivo(auth()->user()->id);
            foreach ($possessi as $possesso) {
                if ($possesso->ID == $obbiettivo->ID) {$giaPos = true; break;}
            }
        }
        return view('modificaObbiettivo')->with('obbiettivo',$obbiettivo)->with('modifica', $modifica)
                ->with('giaDes',$giaDes)->with('giaPos',$giaPos);
    }
    
    public function eseguiModifica(Request $request) {
        if(auth()->check() && auth()->user()->permessi) {
            $db = new DB();
            $db->modificaObbiettivo($request->input("id"), $request->input("nome"), $request->input("lmin"),
                $request->input("lmax"), $request->input("f"), $request->input("flmax"), $request->input("rating"),
                $request->input("marca"), $request->input("tag"), $request->input("oss"));
            
            if ($request->immagine) {
                $request->validate(['immagine' => 'required|image|mimes:png|max:2048']);
                $request->immagine->move(public_path('img'), $request->input("id") . ".png");
            }
            return Redirect::to(route('obbiettivi', ["modifica" => "modifica"]));
        } else {
            return Redirect::to(route('home'));
        }
    }
    
    
    public function univoco($id, $obbiettivo) {
        $risposta = count(Obbiettivo::where([
            ['Nome Completo', $obbiettivo],
            ['ID', "!=", $id]])->get());
        return response($risposta);
    }
}