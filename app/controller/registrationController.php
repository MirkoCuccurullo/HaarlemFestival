<?php

require __DIR__ . '/../service/userService.php';

class registrationController {

    private $userService;
    public function __construct()
    {
        $this->userService = new userService();
    }

    /**
     * @throws Exception
     */
    public function displayRegistration() : void {
        $invalidChar = "";
        $dateInPast = "";
        $emailError = "";
        $captchaMessage = "";
        $isRegistered = false;
        try {
            if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['submit'])) {

                $response = $_POST['g-recaptcha-response'];
                if (!empty($response)) { // check if captcha response is not empty
                   if ($this->userService->verifyCaptchaResponse($response)) {
                        $email = $_POST['email'];
                        $name = $_POST['name'];
                        $dateOfBirth = $_POST['date_of_birth'];

                        // Check if email is already in use
                        if ($this->userService->isEmailAlreadyInUse($email)) {
                            $emailError = "Email already in use";
                        }
                        // Check for invalid characters in name
                        else if (!preg_match('/^[a-zA-Z ]+$/', $name)) {
                            $invalidChar = "Oops, Invalid characters, use alphabets only";
                        }
                        // Check if date of birth is in the past
                        else if (!$this->userService->dateInPast()) {
                            $dateInPast = "Oops, Date of birth must be in the past";
                        }
                        // Register user if all conditions are met
                        else {
                            $this->registerUser($_POST);
                            $isRegistered = true;
                            $successMessage = "Registration successful!";
                        }
                    }
               } else {
                    $captchaMessage = "Please, verify that you are not a robot";
                }
           }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        require __DIR__ . "/../view/registration/registration.php";
    }

    /**
     * @throws Exception
     */
    public function registerUser($data) :void{
        try {
            $this->userService->registerUser($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}