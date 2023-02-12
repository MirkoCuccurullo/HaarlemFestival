<?php
require __DIR__ . '/../service/userService.php';
require __DIR__ . '/../service/SMTPServer.php';


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
        require __DIR__ . '/../view/management/manageProfile.php';
    }

    public function updateProfile()
    {
        if(isset($_POST['editProfile']))
        {
            $name = htmlspecialchars($_POST['profileName']);
            $email = htmlspecialchars($_POST['email']);
            $id = $_SESSION['id'];

            $this->userService->updateUser($id, $name, $email);
            $message = "Hello " . $name . ", your profile changes have been applied. ";
            $this->smtpServer->sendEmail($email, $name, $message, "Profile changes");
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

            $this->smtpServer->sendEmail();
        }
    }
}