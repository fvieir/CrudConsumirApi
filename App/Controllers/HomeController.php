<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        $url = 'http://localhost/api-produtos/product/read.php';
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

        $result = json_decode(curl_exec($curl));

        var_dump($result);
    }
}

?>