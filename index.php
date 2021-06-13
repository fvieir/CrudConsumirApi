<?php

use App\App;

error_reporting(E_ALL & ~E_NOTICE);

require_once "vendor/autoload.php";

try {
    $app = new App();
    $app->run();
} catch (\Exception $e) {
 echo 'Erro => '.$e->getMessage();
}

?>