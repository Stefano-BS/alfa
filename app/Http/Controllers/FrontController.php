<?php
namespace App\Http\Controllers;
use App\Obbiettivo;
use App\Corpo;
use Session;
use Illuminate\Support\Facades\Redirect;

class FrontController extends Controller
{
    public function getHome(){
        $obbiettivi = Obbiettivo::all()->random(4);
        $corpo = Corpo::all()->random(1)[0];
        return view('index')->with('obbiettivi',$obbiettivi)->with('corpo',$corpo);
    }
    
    public function strumenti(){
        return view('strumenti')->with('obbiettivi', Obbiettivo::all());
    }
    
    public function cambiaLingua($lingua) {
        Session::put('lingua', $lingua);
        return Redirect::back();
    }
}
