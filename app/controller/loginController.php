<?php

use router\router;

require '../service/userService.php';

class loginController
{
    public function login($postEmail, $postPassword){

        $email = htmlspecialchars($postEmail);
        $password = htmlspecialchars($postPassword);

        $userService = new userService();
        $currentUser = $userService->logUserIn($email, $password);

        session_start();
        if ($currentUser != null){
            $_SESSION['current_user'] = $currentUser;
            $router = new router();
            $router->route('/');
        }
        else{
            echo "user does not exist";
        }

    }
}