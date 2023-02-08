<?php

class LoginController
{
    public function login()
    {
        require("../view/home/login.php");
    }


    public function logout()
    {
        require("../view/home/logout.php");
    }

    public function validateLogin($email, $password)
    {
        require_once("../repository/userRepository.php");
        $repo = new userRepository();
        return $repo->validateLogin($email, $password);

    }
}