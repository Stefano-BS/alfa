<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\DB;
use Session;

class ProfiloController extends Controller
{
    public function profilo($utente){
        session_start();
        if(isset($_SESSION['logged'])) {
            if ($utente !== $_SESSION['loggedName']) {
                return Redirect::to(route('home'));
            }
            $db = new DB();
            
            return view('profilo')->with('logged',true)->with('loggedName', $_SESSION['loggedName'])->with('admin', $_SESSION['admin'])->with('lingua', Session::get('lingua'))
                    ->with('desideri',$db->elencoDesideriObbiettivo($_SESSION['idUtente']))->with('possessi',$db->elencoPossessiObbiettivo($_SESSION['idUtente']))
                    ->with('desideriCorpo',$db->elencoDesideriCorpo($_SESSION['idUtente']))->with('possessiCorpo',$db->elencoPossessiCorpo($_SESSION['idUtente']));
        } else {
            return Redirect::to(route('home'));
        }
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
        session_start();
        if(isset($_SESSION['logged'])) {
            if ($utente !== $_SESSION['loggedName']) {
                return Redirect::to(route('home'));
            }
            if ($modo == 0) {
                (new DB())->rimuoviDesiderioObbiettivo($_SESSION['idUtente'], $articolo);
            } elseif ($modo == 1) {
                (new DB())->rimuoviPossessoObbiettivo($_SESSION['idUtente'], $articolo);
            } elseif ($modo == 2) {
                (new DB())->aggiungiPossessoObbiettivo($_SESSION['idUtente'], $articolo);
            } elseif ($modo == 3) {
                (new DB())->aggiungiDesiderioObbiettivo($_SESSION['idUtente'], $articolo);
            } elseif ($modo == 4) {
                (new DB())->rimuoviDesiderioCorpo($_SESSION['idUtente'], $articolo);
            } elseif ($modo == 5) {
                (new DB())->rimuoviPossessoCorpo($_SESSION['idUtente'], $articolo);
            } elseif ($modo == 6) {
                (new DB())->aggiungiPossessoCorpo($_SESSION['idUtente'], $articolo);
            } elseif ($modo == 7) {
                (new DB())->aggiungiDesiderioCorpo($_SESSION['idUtente'], $articolo);
            }
            return Redirect::to(route('paginaUtente', ['utente' => $_SESSION['loggedName']]));
        } else {
            return Redirect::to(route('home'));
        }
    }
    
    public function cambiaLingua($utente, $lingua){
        Session::put('lingua', $lingua);
        $db = new DB();
        session_start();
        $db->cambiaLingua($_SESSION['idUtente'], $lingua);
        return Redirect::back();//Redirect::to(route('paginaUtente',['utente' => $utente]));
    }
    
    public function cambiaImmagine(Request $request, $utente){
        $request->validate(['immagine' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
        $request->immagine->move(public_path('utenti'), $utente);
        return Redirect::to(route('paginaUtente',['utente' => $utente]));
    }
}