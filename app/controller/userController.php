<?php


use router\router;


require_once __DIR__ . '/../service/userService.php';
require_once '../service/SMTPServer.php';

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

    public function manageProfile($id)
    {
        $user = $this->userService->getUserById($id);
        require __DIR__ . '/../view/management/manageProfile.php';
    }


    public function manageAllUsers(){
        require __DIR__ . '/../view/management/manageUsers.php';
    }

    public function updateProfile($id)
    {
        if (isset($_POST['editProfile'])) {
            $name = htmlspecialchars($_POST['profileName']);
            $email = htmlspecialchars($_POST['email']);

            $this->userService->updateUser($id, $name, $email);
            $_SESSION['current_user_email'] = $email;
            header('location: /home');
            //$message = "Hello " . $name . ", your profile changes have been applied. ";
            //$this->smtpServer->sendEmail($email, $name, $message, "Profile changes");
        } else if (isset($_POST['editPassword'])) {
            $_SESSION['err_msg'] = "";
            $hashedPassword = $_SESSION['current_user_password'];
            $currentPassword = htmlspecialchars($_POST['currentPassword']);
            $newPassword = htmlspecialchars($_POST['newPassword']);
            $verifyPassword = htmlspecialchars($_POST['verifyPassword']);
            if (password_verify($currentPassword, $hashedPassword)) {
                if ($currentPassword != $newPassword) {
                    if ($newPassword == $verifyPassword) {
                        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        $this->userService->resetUserPassword($id, $newHashedPassword);
                        $_SESSION['err_msg'] = "Your password has been reset!";
                        $_SESSION['status'] = "success";

                    } else {
                        $_SESSION['err_msg'] = "The 2 passwords do not match.";
                        $_SESSION['status'] = "danger";
                    }

                } else {
                    $_SESSION['err_msg'] = "The new password is the same as the old one.";
                    $_SESSION['status'] = "danger";
                }

            }
            else {
                $_SESSION['err_msg'] = "Your password is incorrect";
                $_SESSION['status'] = "danger";
            }

            $this->manageProfile();
            unset($_SESSION['err_msg']);
        }
    }


    public function displayResetPassword()
    {
        require __DIR__ . '/../view/resetPassword/resetPassword.php';
    }

    public function resetPassword()
    {

        if (isset($_POST['resetPassword'])) {
            $id = $_SESSION['current_user_id'];
            $password = htmlspecialchars($_POST['password']);
            $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

            if($password == $confirmPassword)
            {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->userService->resetUserPassword($id, $hashedPassword);
                $this->login();
            }

        }
    }

    public function sendResetLink()
    {
        if(isset($_POST['sendResetLink']))
        {
            $email = htmlspecialchars($_POST['resetEmail']);
            $user = $this->userService->getUserByEmail($email);
            if($user != null) {
                $_SESSION['current_user_id'] = $user->id;
                $name = $user->name;
                $subject = "Password reset link";
                $message = "Hello " . $name . ", here is the password reset link you have requested: " . "<a href='http://localhost/resetPassword'>link</a>";
                $this->smtpServer->sendEmail($email, $name, $message, $subject);
                $_SESSION['err_msg'] = "A reset link has been sent to your email.";
                $_SESSION['status'] = "success";
            }
            else {
                $_SESSION['err_msg'] = "The email you entered is not in use.";
                $_SESSION['status'] = "danger";
            }

            $this->login();
            unset($_SESSION['err_msg']);
        }
    }

    public function editUser()
    {
        //require_once __DIR__ . '/../model/user.php';
        //$user = $this->userService->getUser($id);
        //require __DIR__ . '/../view/management/editUser.php';
        if (isset($_POST['sendResetLink'])) {
            $email = htmlspecialchars($_POST['resetEmail']);
            $user = $this->userService->getUserByEmail($email);
            if ($user != null) {
                $name = $user->name;
                $id = $user->id;
                $message = "Hello " . $name . ", you have requested a password reset. Please click on the link below to reset your password. http://localhost:8080/resetPassword?id=" . $id;
                $this->smtpServer->sendEmail($email, $name, $message, "Password reset");
                $this->login();
            } else {
                $_SESSION['err_msg'] = "The email you entered is not in use.";
                $_SESSION['status'] = "danger";
            }

            $this->login();
            unset($_SESSION['err_msg']);

        }
    }

}