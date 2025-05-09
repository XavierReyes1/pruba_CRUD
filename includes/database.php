<?php

$db = new PDO('mysql: host=localhost;dbname=practica', 'root','root');
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);