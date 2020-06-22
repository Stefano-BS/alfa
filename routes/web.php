<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['lingua']], function() {
    Route::get('/', ['as' => 'home','uses' => 'FrontController@getHome']);

    Route::get('/accesso', ['as' => 'accesso','uses' => 'AuthController@autenticazione']);
    Route::post('/accesso', ['as' => 'accesso','uses' => 'AuthController@accesso']);
    Route::get('/uscita', ['as' => 'uscita','uses' => 'AuthController@logout']);

    Route::get('/{utente}/profilo', ['as' => 'paginaUtente','uses' => 'ProfiloController@profilo']);
    Route::post('/{utente}/profilo', ['as' => 'immagine','uses' => 'ProfiloController@cambiaImmagine']);
    Route::get('/{utente}/profilo/cambialingua/{lingua}', ['as' => 'cambiaLingua','uses' => 'ProfiloController@cambiaLingua']);
    Route::get('/{utente}/profilo/rimozionedesiderioobbiettivo/{id}', ['as' => 'rimozioneDesiderioObbiettivo','uses' => 'ProfiloController@rimozioneDesiderioObbiettivo']);
    Route::get('/{utente}/profilo/rimozionepossessoobbiettivo/{id}', ['as' => 'rimozionePossessoObbiettivo','uses' => 'ProfiloController@rimozionePossessoObbiettivo']);
    Route::get('/{utente}/profilo/aggiuntadesiderioobbiettivo/{id}', ['as' => 'aggiuntaDesiderioObbiettivo','uses' => 'ProfiloController@aggiuntaDesiderioObbiettivo']);
    Route::get('/{utente}/profilo/aggiuntapossessoobbiettivo/{id}', ['as' => 'aggiuntaPossessoObbiettivo','uses' => 'ProfiloController@aggiuntaPossessoObbiettivo']);
    Route::get('/{utente}/profilo/rimozionedesideriocorpo/{id}', ['as' => 'rimozioneDesiderioCorpo','uses' => 'ProfiloController@rimozioneDesiderioCorpo']);
    Route::get('/{utente}/profilo/rimozionepossessocorpo/{id}', ['as' => 'rimozionePossessoCorpo','uses' => 'ProfiloController@rimozionePossessoCorpo']);
    Route::get('/{utente}/profilo/aggiuntadesideriocorpo/{id}', ['as' => 'aggiuntaDesiderioCorpo','uses' => 'ProfiloController@aggiuntaDesiderioCorpo']);
    Route::get('/{utente}/profilo/aggiuntapossessocorpo/{id}', ['as' => 'aggiuntaPossessoCorpo','uses' => 'ProfiloController@aggiuntaPossessoCorpo']);

    Route::get('/obbiettivi/{modifica?}', ['as' => 'obbiettivi','uses' => 'ObbiettiviController@tabella']);
    Route::post('/obbiettivi/{modifica?}', ['as' => 'obbiettivi','uses' => 'ObbiettiviController@tabella']);

    Route::get('obbiettivi/{obbiettivo}/{modifica}', ['as' => 'modificaObbiettivo','uses' => 'ObbiettiviController@pagina']);
    Route::post('obbiettivi/{obbiettivo}/{modifica}', ['as' => 'modificaObbiettivo','uses' => 'ObbiettiviController@eseguiModifica']);

    Route::get('corpi/{modifica?}', ['as' => 'corpi','uses' => 'CorpiController@tabella']);
    Route::post('corpi/{modifica?}', ['as' => 'corpi','uses' => 'CorpiController@tabella']);

    Route::get('corpi/{corpo}/{modifica}', ['as' => 'modificaCorpo','uses' => 'CorpiController@pagina']);
    Route::post('corpi/{corpo}/{modifica}', ['as' => 'modificaCorpo','uses' => 'CorpiController@eseguiModifica']);

    Route::get('/strumenti', ['as' => 'strumenti','uses' => 'FrontController@strumenti']);
});