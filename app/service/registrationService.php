<?php

require __DIR__ . '/../repository/registrationRepository.php';

class registrationService{
    private $registrationRepository;

    public function __construct(){
        $this->registrationRepository = new registrationRepository();
    }

    /**
     * @throws Exception
     */
    public function registerUser(array $data): array
    {
        $validationResult = $this->validateData($data);
        if ($validationResult !== true) {
            return $validationResult;
        }

        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $preparedData = $this->prepareData($data);
            $hashedSaltedPassword = password_hash($preparedData['password'], PASSWORD_DEFAULT);
            //show these messages into a hidden Label !!
            if ($this->registrationRepository->insertUserToDatabase($preparedData['name'], $preparedData['email'], $hashedSaltedPassword, $preparedData['date_of_birth'])) {
                return ["success" => "Data has been processed successfully."];
            } else {
                return ["error" => "An error occurred while processing data."];
            }
        }
        else{
            //add a statement
            echo "Could not do POST";
        }

    }

    private function validateData(array $data): bool|array
    {
        if (empty($data["name"])) {
            return ["error" => "Name is required"];
        }
        if (empty($data["email"])) {
            return ["error" => "Email is required"];
        }
        if (empty($data["password"])) {
            return ["error" => "Password is required"];
        }
        if (empty($data["date_of_birth"])) {
            return ["error" => "Date of Birth is required"];
        }

        return true;
    }

    private function prepareData(array $data): array
    {
        return [
            'name' => htmlspecialchars($data['name']),
            'email' => htmlspecialchars($data['email']),
            'date_of_birth' => htmlspecialchars($data['date_of_birth']),
            'password' => htmlspecialchars($data['password']),
        ];
    }



    // Later: maybe use in registerUser method and give out label msg
    public function emailInUse($email){
        return $this->registrationRepository->emailInUse($email);
    }


    //    public function registerNewUser($name, $email, $hashedSaltedPassword, $date_of_birth): bool
//    {
//        return $this->registrationRepository->registerUser($name, $email, $hashedSaltedPassword, $date_of_birth);
//    }
}