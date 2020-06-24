<?php
function barra($active){
    if (auth()->check()) {
        $haImmagine = file_exists($_SERVER['DOCUMENT_ROOT'] . "/laravel/public/utenti/" . auth()->user()->email);
        echo "<li ". $active ."><a href=" . route('paginaUtente', ['utente' => auth()->user()->email]) . ">";
        if ($haImmagine) {
            echo "<img src=". route('/') ."/utenti/" . auth()->user()->email . " class='img-circle' style='height: 18px; width: 18px'/>";
        } else {
            echo "<span class='glyphicon glyphicon-user'></span>";
        }
        echo "  " . auth()->user()->name ."</a></li>";
        echo "<li><a href='' onclick='event.preventDefault(); document.getElementById(\"logout-btn\").submit();'><span class='glyphicon glyphicon-log-out'></span>  " . trans('str.esci') ."</a></li>";
        echo "<form id='logout-btn' action='" . route('logout') . "' method='post'></form>";
    } else {
        if (app()->getLocale() == "it") {
            echo "<li><a href=". route('lingua', ['lingua' => "en"]) ."><img src='". route('/') . "/img/en.png" ."' class='img-rounded' height='18'/></a></li>";
        } else {
            echo "<li><a href=". route('lingua', ['lingua' => "it"]) ."><img src='". route('/') . "/img/it.png" ."' class='img-rounded' height='18'/></a></li>";
        }
        echo "<li " . $active ."><a href=". route('login') ."><span class='glyphicon glyphicon-user'></span>  " . trans('str.accedi') ."</a></li>";
    }
}