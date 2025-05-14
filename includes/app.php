<?php

use Model\ActiveRecord;

include_once __DIR__.'/../vendor/autoload.php';

require 'database.php';
require 'funciones.php';


ActiveRecord::setDB($db);