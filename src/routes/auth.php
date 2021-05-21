<?php

use Firebase\JWT\JWT;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//require "../../src/config/db.php";
$app = new \Slim\App;

function generateToken($studentId): string
{
    $now = time();
    $future = strtotime('+3 hour', $now);
    $secret = OAUTH_SECTRET_KEY;

    $payload = [
        "jti" => $studentId,
        "iat" => $now,
        "exp" => $future
    ];

    return JWT::encode($payload, $secret, "HS256");
}

//Route to use to get token
$app->post('/api/token', function (Request $request, Response $response, array $args) {
    $id = $request->getParsedBody()['id'];
    $pin = $request->getParsedBody()['pin'];

    $sql = "SELECT * FROM students WHERE student_id = $id && pin=$pin";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $query = $db->prepare("SELECT * FROM students WHERE student_id=:student_id AND pin=:pin");
        $query->bindParam("student_id", $id, PDO::PARAM_STR);
        $query->bindParam("pin", $pin, PDO::PARAM_STR);

        $query->execute();
        if ($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $response->withJson(array(
                "token" => generateToken($id)
            ));
        } else {
            return $response->withJson(
                array("error" => "Invalid Credentials")
            );
        }
    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}';
    }

});

