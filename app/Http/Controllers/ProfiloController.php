<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\DB;
use Session;

class ProfiloController extends Controller
{
    public function profilo($utente){
        if (auth()->guest() or auth()->user()->email !== $utente) {
            return Redirect::to(route('home'));
        }
        $db = new DB();
        return view('profilo')->with('lingua', Session::get('lingua'))
                    ->with('desideri',$db->elencoDesideriObbiettivo(auth()->user()->id))->with('possessi',$db->elencoPossessiObbiettivo(auth()->user()->id))
                    ->with('desideriCorpo',$db->elencoDesideriCorpo(auth()->user()->id))->with('possessiCorpo',$db->elencoPossessiCorpo(auth()->user()->id));
//        session_start();
//        if(isset($_SESSION['logged'])) {
//            if ($utente !== $_SESSION['loggedName']) {
//                return Redirect::to(route('home'));
//            }
//            $db = new DB();
//            
//            return view('profilo')->with('logged',true)->with('loggedName', $_SESSION['loggedName'])->with('admin', $_SESSION['admin'])->with('lingua', Session::get('lingua'))
//                    ->with('desideri',$db->elencoDesideriObbiettivo($_SESSION['idUtente']))->with('possessi',$db->elencoPossessiObbiettivo($_SESSION['idUtente']))
//                    ->with('desideriCorpo',$db->elencoDesideriCorpo($_SESSION['idUtente']))->with('possessiCorpo',$db->elencoPossessiCorpo($_SESSION['idUtente']));
//        } else {
//            return Redirect::to(route('home'));
//        }
    }
    
    public function rimozionePossessoObbiettivo($utente, $id){return $this->azione($utente, $id, 1);}
    public function rimozioneDesiderioObbiettivo($utente, $id){return $this->azione($utente, $id, 0);}
    public function aggiuntaPossessoObbiettivo($utente, $id){return $this->azione($utente, $id, 2);}
    public function aggiuntaDesiderioObbiettivo($utente, $id){return $this->azione($utente, $id, 3);}
    public function rimozionePossessoCorpo($utente, $id){return $this->azione($utente, $id, 5);}
    public function rimozioneDesiderioCorpo($utente, $id){return $this->azione($utente, $id, 4);}
    public function aggiuntaPossessoCorpo($utente, $id){return $this->azione($utente, $id, 6);}
    public function aggiuntaDesiderioCorpo($utente, $id){return $this->azione($utente, $id, 7);}
    
    function azione($utente, $articolo, $modo){
        if(auth()->guest() or auth()->user()->email !== $utente) {
            return Redirect::to(route('home'));
        }
        if ($modo == 0) {
            (new DB())->rimuoviDesiderioObbiettivo(auth()->user()->id, $articolo);
        } elseif ($modo == 1) {
            (new DB())->rimuoviPossessoObbiettivo(auth()->user()->id, $articolo);
        } elseif ($modo == 2) {
            (new DB())->aggiungiPossessoObbiettivo(auth()->user()->id, $articolo);
        } elseif ($modo == 3) {
            (new DB())->aggiungiDesiderioObbiettivo(auth()->user()->id, $articolo);
        } elseif ($modo == 4) {
            (new DB())->rimuoviDesiderioCorpo(auth()->user()->id, $articolo);
        } elseif ($modo == 5) {
            (new DB())->rimuoviPossessoCorpo(auth()->user()->id, $articolo);
        } elseif ($modo == 6) {
            (new DB())->aggiungiPossessoCorpo(auth()->user()->id, $articolo);
        } elseif ($modo == 7) {
            (new DB())->aggiungiDesiderioCorpo(auth()->user()->id, $articolo);
        }
        return Redirect::to(route('paginaUtente', auth()->user()->email));
    }
    
    public function cambiaLingua($utente, $lingua){
        if ($utente !== auth()->user()->email) {
            return Redirect::back();
        }
        Session::put('lingua', $lingua);
        $db = new DB();
        $db->cambiaLingua(auth()->user()->id, $lingua);
        return Redirect::back();
    }
    
    public function cambiaImmagine(Request $request, $utente){
        $request->validate(['immagine' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
        $request->immagine->move(public_path('utenti'), $utente);
        return Redirect::to(route('paginaUtente',['utente' => $utente]));
    }
}