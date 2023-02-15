<?php
require __DIR__ . '/../service/userService.php';
require '../service/SMTPServer.php';
include_once __DIR__ . '/../model/user.php';


class userController
{
    private $userService;
    private $smtpServer;

    public function __construct()
    {
        $this->userService = new userService();
        $this->smtpServer = new SMTPServer();
    }

    public function login()
    {
        require __DIR__ . '/../view/login/login.php';
    }

    public function register()
    {
        require __DIR__ . '/../view/registration/registration.php';
    }

    public function manageProfile()
    {
        $user = $this->userService->getUserByEmail($_SESSION['current_user_email']);
        require __DIR__ . '/../view/management/manageProfile.php';
    }

    public function updateProfile()
    {
        $id = $_SESSION['current_user_id'];
        if(isset($_POST['editProfile']))
        {
            $name = htmlspecialchars($_POST['profileName']);
            $email = htmlspecialchars($_POST['email']);

            $this->userService->updateUser($id, $name, $email);
            $_SESSION['current_user_email'] = $email;
            header('location: /home');
            //$message = "Hello " . $name . ", your profile changes have been applied. ";
            //$this->smtpServer->sendEmail($email, $name, $message, "Profile changes");
        }

        else if(isset($_POST['editPassword']))
        {
            $hashedPassword = $_SESSION['current_user_password'];
            $currentPassword = htmlspecialchars($_POST['currentPassword']);
            $newPassword = htmlspecialchars($_POST['newPassword']);
            $verifyPassword = htmlspecialchars($_POST['verifyPassword']);
            if(password_verify($currentPassword, $hashedPassword))
            {
                if ($currentPassword != $newPassword)
                {
                    if($newPassword == $verifyPassword)
                    {
                        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        $this->userService->resetUserPassword($id, $newHashedPassword);
                    }
                }
            }
        }
    }



    public function displayResetPassword()
    {
        require __DIR__ . '/../view/resetPassword/resetPassword.php';
    }

    public function resetPassword()
    {
        if(isset($_POST['resetPassword']))
        {

        }
    }

    public function sendResetLink()
    {
        if(isset($_POST['sendResetLink']))
        {
            $email = htmlspecialchars($_POST['resetEmail']);
            $user = $this->userService->getUserByEmail($email);
            $name = $user->name;
            $subject = "Password reset link";
            $message = "Hello " . $name . ", here is the password reset link you have requested: ";
            $this->smtpServer->sendEmail($email, $name, $message, $subject);
        }
    }
}