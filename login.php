<?php
require 'vendor/autoload.php';

use csoc\Alcatel\AluApi;

if (filter_var($_SERVER['argv'][1], FILTER_VALIDATE_IP)) {
    if ($_SERVER['argv'][2]=="8080" || $_SERVER['argv'][2] == "80") {
        $ipModem    = $_SERVER['argv'][1].":".$_SERVER['argv'][2];
        $username   = $_SERVER['argv'][3];
        $password   = $_SERVER['argv'][4];
    } else {
        $ipModem    = $_SERVER['argv'][1];
        $username   = $_SERVER['argv'][2];
        $password   = $_SERVER['argv'][3];
    }
}

$debug = false;

$alu = new AluApi($ipModem, $username, $password, $debug);

$login = $alu->login();

var_dump($login);

?>