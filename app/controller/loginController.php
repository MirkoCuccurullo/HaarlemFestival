<?php

use router\router;

require '../service/userService.php';

class loginController
{
    /**
     * @throws Exception
     */
    public function login($postEmail, $postPassword): void
    {

        $email = htmlspecialchars($postEmail);
        $password = htmlspecialchars($postPassword);

        $userService = new userService();
        $currentUser = $userService->logUserIn($email, $password);

        if ($currentUser != null){
            $_SESSION['current_user'] = $currentUser;
            $_SESSION['current_user_email'] = $currentUser->email;
            $_SESSION['current_user_id'] = $currentUser->id;
            $_SESSION['current_user_password'] = $currentUser->password;
            $router = new router();
            $router->route('/');
        }
        else{
            echo "user does not exist";
        }

    }
}