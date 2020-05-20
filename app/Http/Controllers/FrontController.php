<?php
namespace App\Http\Controllers;
use App\Obbiettivo;
use App\Corpo;

class FrontController extends Controller
{
    public function getHome(){
        session_start();
        $obbiettivi = Obbiettivo::all()->random(4);
        $corpo = Corpo::all()->random(1)[0];
        if(isset($_SESSION['logged'])) {
            return view('index')->with('logged',true)->with('loggedName', $_SESSION['loggedName'])->with('obbiettivi',$obbiettivi)->with('corpo',$corpo);
        } else {
            return view('index')->with('logged',false)->with('obbiettivi',$obbiettivi)->with('corpo',$corpo);
        }
    }
    
    public function strumenti(){
        session_start();
        if(isset($_SESSION['logged'])) {
            return view('strumenti')->with('logged',true)->with('loggedName', $_SESSION['loggedName']);
        } else {
            return view('strumenti')->with('logged',false);
        }
    }
}
