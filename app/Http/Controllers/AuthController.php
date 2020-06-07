<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DB;
use Session;

class AuthController extends Controller
{
    public function autenticazione(){
        return view('auth')->with('logged',false)->with('messaggio', "Accesso");
    }
    
    public function accesso(Request $request){
        $db = new DB();
        if ($request->input('login-submit') == "Registrati") {
            $successo = $db->registraUtente($request->input('username'), $request->input('password'));
            if ($successo) {
                $risultatoAccesso = $db->accedi($request->input('username'), $request->input('password'));
                session_start();
                $_SESSION['logged'] = true;
                $_SESSION['loggedName'] = $request->input('username');
                $_SESSION['idUtente'] = $risultatoAccesso[1];
                $_SESSION['admin'] = $risultatoAccesso[2];
                Session::forget('lingua');
                Session::put('lingua', $risultatoAccesso[3]);
                return view('index')->with('logged',true)->with('loggedName', $request->input('username'));
            } else {
                return view('auth')->with('logged',false)->with('messaggio', "Utente già registrato");
            }
        } else {
            $risultatoAccesso = $db->accedi($request->input('username'), $request->input('password'));
            if ($risultatoAccesso[0] == false) {
                return view('auth')->with('logged',false)->with('messaggio', "Credenziali errate");
            } else {
                session_start();
                $_SESSION['logged'] = true;
                $_SESSION['loggedName'] = $request->input('username');
                $_SESSION['idUtente'] = $risultatoAccesso[1];
                $_SESSION['admin'] = $risultatoAccesso[2];
                Session::forget('lingua');
                Session::put('lingua', $risultatoAccesso[3]);
                return Redirect::to(route('home'));
            }
        }
    }
    
    public function logout(){
        session_start();
        session_destroy();
        $_SESSION['logged'] = false;
        $_SESSION['loggedName'] = "";
        $_SESSION['idUtente'] = -1;
        $_SESSION['admin'] = false;
        Session::forget('lingua');
        return Redirect::to(route('home'));
    }
}