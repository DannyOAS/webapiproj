<?php

use Firebase\JWT\JWT;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//require "../../src/config/db.php";
$app = new \Slim\App;


//Route to use to get token
$app->get('/api/transactions', function (Request $request, Response $response, array $args) {
    $payload = [];
    array_push($payload, array("id"=>"11"  ,"amount"=>1993, "fee_type"=>"ACADEMIC"));
    array_push($payload, array("id"=>"11"  ,"amount"=>1993, "fee_type"=>"ACADEMIC"));

    return $response->withJSON($payload);

});

