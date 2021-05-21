<?php

use Firebase\JWT\JWT;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Matscode\Paystack\Transaction;
use Matscode\Paystack\Utility\Debug; // for Debugging purpose
use Matscode\Paystack\Utility\Http;



// creating the transaction object

//require "../../src/config/db.php";
$app = new \Slim\App;



$app->get('/api/transactions', function (Request $request, Response $response, array $args) {
    $payload = [];
    array_push($payload, array("id"=>"11"  ,"amount"=>1993, "fee_type"=>"ACADEMIC"));
    array_push($payload, array("id"=>"11"  ,"amount"=>1993, "fee_type"=>"ACADEMIC"));

    return $response->withJSON($payload);
});


$app->post('/api/make-payment', function (Request $request, Response $response, array $args) {
    $secretKey = 'sk_test_f67db477aeacf65fe448dac9b485a3639a95c031';
    $Transaction = new Transaction( $secretKey);
    $response =
        $Transaction
            ->setCallbackUrl('http://michaelakanji.com') // to override/set callback_url, it can also be set on your dashboard
            ->setEmail( 'matscode@gmail.com' )
            ->setAmount( 75000 ) // amount is treated in Naira while using this method
            ->initialize();

    return $response->withJSON(array("hi"=>"j"));
});
