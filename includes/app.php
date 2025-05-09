<?php

use Model\ActiveRecord;

include_once __DIR__.'/../vendor/autoload.php';

require 'database.php';

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

ActiveRecord::setDB($db);