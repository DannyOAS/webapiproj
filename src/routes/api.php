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
    $db = new db();
    // Connect
    $db = $db->connect();
    $query = $db->prepare("INSERT INTO transactions(reference_no, fee_type, payment_type, amount) VALUES (reference_no, fee_type, payment_type, amount)");
    $query->bindParam("reference_no", $request->getParsedBody()["reference_no"], PDO::PARAM_STR);
    $query->bindParam("fee_type", $request->getParsedBody()["fee_type"], PDO::PARAM_STR);
    $query->bindParam("payment_type", $request->getParsedBody()["payment_type"], PDO::PARAM_STR);
    $query->bindParam("amount", $request->getParsedBody()["amount"], PDO::PARAM_STR);


    $query->execute();
    return $db->lastInsertId();

    print_r($request->getParsedBody());
    return $response->withJSON(array("hi"=>"j"));
});
