<?php

use Firebase\JWT\JWT;

require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../../service/userService.php';
require_once __DIR__ . '/../../model/user.php';
require_once __DIR__ . '/../../vendor/autoload.php';

class JwtGeneratorController extends controller
{
    private $userService;

    // initialize services
    function __construct()
    {
        $this->userService = new userService();
    }
    public function generateToken() {

        // generate jwt
        $tokenResponse = $this->generateJwt();

        $this->respond($tokenResponse);
    }

    public function generateJwt() {
        $secret_key = "YOUR_SECRET_KEY";

        $issuer = "THE_ISSUER"; // this can be the domain/servername that issues the token
        $audience = "THE_AUDIENCE"; // this can be the domain/servername that checks the token

        $issuedAt = time(); // issued at
        $notbefore = $issuedAt; //not valid before
        $expire = $issuedAt + 600; // expiration time is set at +600 seconds (10 minutes)

        // JWT expiration times should be kept short (10-30 minutes)
        // A refresh token system should be implemented if we want clients to stay logged in for longer periods

        // note how these claims are 3 characters long to keep the JWT as small as possible
        $payload = array(
            "iss" => $issuer,
            "aud" => $audience,
            "iat" => $issuedAt,
            "nbf" => $notbefore,
            "exp" => $expire
           );

        $jwt = JWT::encode($payload, $secret_key, 'HS256');

        return
            array(
                "message" => "Successful login.",
                "jwt" => $jwt,
                "expireAt" => $expire
            );
    }
}