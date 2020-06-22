<?php
function barra($logged, $loggedName, $active){
    if ($logged) {
        $loggedName = $_SESSION['loggedName'];
        $haImmagine = file_exists($_SERVER['DOCUMENT_ROOT'] . "/laravel/public/utenti/" . $loggedName);
        echo "<li ". $active ."><a href=" . route('paginaUtente', ['utente' => $loggedName]) . ">";
        if ($haImmagine) {
            echo "<img src=". route('home') ."/utenti/" . $loggedName . " class='img-circle' style='height: 18px; width: 18px'/>";
        } else {
            echo "<span class='glyphicon glyphicon-user'></span>";
        }
        echo "  " . $loggedName ."</a></li>";
        echo "<li><a href=". route('uscita') ."><span class='glyphicon glyphicon-log-out'></span>  " . trans('str.esci') ."</a></li>";
    } else {
    echo "<li><a href=". route('accesso') ."><span class='glyphicon glyphicon-user'></span>  " . trans('str.accedi') ."</a></li>";
    }
}