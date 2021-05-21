<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../vendor/autoload.php';
require '../src/config/db.php';

define("OAUTH_SECTRET_KEY", "DMID@(ldldq-U*U@)IKKDMMKAMJNIU#JO$");

$app = new \Slim\App;
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->get('/api', function (Request $request, Response $response) {

    $response->getBody()->write("WebAPI v1.0");

    return $response;
});


require "../src/routes/api.php";
require "../src/routes/auth.php";


$app->add(new Tuupola\Middleware\JwtAuthentication([
    "secret" => OAUTH_SECTRET_KEY,
    "ignore" => ["/api/token", "/api/transactions","/api/login"],//This allows clients to get oauth token
    "algorithm" => ["HS256", "HS384"],
    "attribute" => "AuthUser",

    //Custom error handler
    "error" => function ($response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments["message"];

        return $response
            ->withJson($data);
    }
]));

$app->run();