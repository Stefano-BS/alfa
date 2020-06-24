<?php
namespace App;

use App\User;
use App\Obbiettivo;
use App\Desiderio;
use App\Des;
use App\Possesso;
use App\Poss;

class DB {
    
    //  OBBIETTIVI
    public function elencoObbiettivi($marca, $focaliSelezionate, $apertureSelezionate) {
        if ($marca == trans('str.tutte')) {
            return Obbiettivo::where([
                ['LMin','>=',$focaliSelezionate[0]],
                ['LMax','<=',$focaliSelezionate[1]],
                ['F','<=', $apertureSelezionate[0]],
                ['FLMax','<=', $apertureSelezionate[1]]
            ])->get();
            
        } else {
            return Obbiettivo::where([
                ['Marca', $marca],
                ['LMin','>=',$focaliSelezionate[0]],
                ['LMax','<=',$focaliSelezionate[1]],
                ['F','<=', $apertureSelezionate[0]],
                ['FLMax','<=', $apertureSelezionate[1]]
            ])->get();
        }
    }
    
    public function obbiettivo($id) {return Obbiettivo::find($id);}
    
    public function modificaObbiettivo($id, $nome, $lmin, $lmax, $f, $flmax, $rating, $marca, $tag, $oss) {
        Obbiettivo::find($id)->update(['Nome Completo' => $nome,'LMin'=> (float)$lmin,'LMax' => (float)$lmax,'F'=> (float)$f,'FLMax' => (float)$flmax,'Rating' => $rating,'Marca'=> $marca,'TAG' => $tag,'OSS' => (bool)$oss]);
    }
    
    
    //  CORPI
    public function elencoCorpi() {return Corpo::all();}
    
    public function corpo($id) {return Corpo::find($id);}
    
    public function modificaCorpo($id, $listaAttributi) {
        Corpo::find($id)->update($listaAttributi);
    }
    
    
    //  UTENTI
    /*public function accedi($nome, $password) {
        $query = Utente::where([
            ['Nome',$nome],
            ['Password',md5($password)]
        ])->get();
        
        if (count($query) == 0) {
            return [false, -1, 0];
        } else {
            return  [(md5($password) == $query[0]->Password), $query[0]->ID, $query[0]->permessi, $query[0]->lingua];
        }
    }
    
    function esisteUtente($nome){
        return count(Utente::where('Nome',$nome)->get()) > 0;
    }
    
    public function registraUtente($nome, $password) {
        if ($this->esisteUtente($nome)) {return false;}
        $nuovoUtente = new Utente(['Nome' => $nome, 'Password' => md5($password), 'permessi' => 0]);
        $nuovoUtente->save();
        return true;
    }*/
    
    public function cambiaLingua($id, $valore) {
        User::find($id)->update(['lingua' => $valore]);
    }
    
    
    //  DESIDERI UTENTE
    public function aggiungiDesiderioObbiettivo($idUtente, $idArticolo) {
        (new Desiderio(['IDUtente' => $idUtente,'IDObbiettivo' => $idArticolo]))->save();
    }
    
    public function rimuoviDesiderioObbiettivo($idUtente, $idArticolo) {
        $desiderio = Desiderio::where([['IDUtente',$idUtente],['IDObbiettivo',$idArticolo]]);
        if ($desiderio !== null) {$desiderio->delete();}
    }
    
    public function elencoDesideriObbiettivo($idUtente) {
        return User::find($idUtente)->desideriObbiettivo;
    }
    
    public function aggiungiDesiderioCorpo($idUtente, $idArticolo) {
        (new Des(['IDUtente' => $idUtente,'IDCorpo' => $idArticolo]))->save();
    }
    
    public function rimuoviDesiderioCorpo($idUtente, $idArticolo) {
        $desiderio = Des::where([['IDUtente',$idUtente],['IDCorpo',$idArticolo]]);
        if ($desiderio !== null) {$desiderio->delete();}
    }
    
    public function elencoDesideriCorpo($idUtente) {
        return User::find($idUtente)->desideriCorpo;
    }
    
    
    //  POSSESSI UTENTE
    public function aggiungiPossessoObbiettivo($idUtente, $idArticolo) {
        (new Possesso(['IDUtente' => $idUtente,'IDObbiettivo' => $idArticolo]))->save();
    }
    
    public function rimuoviPossessoObbiettivo($idUtente, $idArticolo) {
        $possesso = Possesso::where([['IDUtente',$idUtente],['IDObbiettivo',$idArticolo]]);
        if ($possesso !== null) {$possesso->delete();}
    }
    
    public function elencoPossessiObbiettivo($idUtente) {
        return User::find($idUtente)->possessiObbiettivo;
    }
    
    public function aggiungiPossessoCorpo($idUtente, $idArticolo) {
        (new Poss(['IDUtente' => $idUtente,'IDCorpo' => $idArticolo]))->save();
    }
    
    public function rimuoviPossessoCorpo($idUtente, $idArticolo) {
        $possesso = Poss::where([['IDUtente',$idUtente],['IDCorpo',$idArticolo]]);
        if ($possesso !== null) {$possesso->delete();}
    }
    
    public function elencoPossessiCorpo($idUtente) {
        return User::find($idUtente)->possessiCorpo;
    }
}