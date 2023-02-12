<?php

require __DIR__ . '/../service/userService.php';

class registrationController {

    private $registrationService;

    public function __construct()
    {
        $this->registrationService = new userService();
    }

    /**
     * @throws Exception
     */
    public function displayRegistrationPage($data) : void {
        require __DIR__ . "/../view/registration/registration.php";
        $this->registerUser($data);
    }

    /**
     * @throws Exception
     */
    public function registerUser($data) : array{
        return $this->registrationService->registerUser($data);
    }

}