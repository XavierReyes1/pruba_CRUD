<?php
function sesionActiva()  {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function debuguear($variable) : void {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}