<?php
require '../service/userService.php';

class loginController
{
    public function login($postEmail, $postPassword){

        $email = htmlspecialchars($postEmail);
        $password = htmlspecialchars($postPassword);

        $userService = new userService();
        $currentUser = $userService->logUserIn($email, $password);

        session_start();
        $_SESSION['current_user'] = $currentUser;

    }
}