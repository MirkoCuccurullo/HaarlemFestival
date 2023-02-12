<?php

require_once '../repository/userRepository.php';
class userService{
    private $userRepo;
    public function __construct(){
        $this->userRepo = new userRepository();
    }
    public function getUser($id){
        return $this->userRepo->getUser($id);
    }
    public function registerUser(array $data)
    {
        $validationResult = $this->validateData($data);
        if ($validationResult !== true) {
            return $validationResult;
        }

        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $preparedData = $this->prepareData($data);
            $hashedSaltedPassword = password_hash($preparedData['password'], PASSWORD_DEFAULT);
            //show these messages into a hidden Label !!
            if ($this->userRepo->insertUserToDatabase($preparedData['name'], $preparedData['email'], $hashedSaltedPassword, $preparedData['date_of_birth'])) {
                return ["success" => "Data has been processed successfully."];
            } else {
                return ["error" => "An error occurred while processing data."];
            }
        } else {
            //add a statement
            echo "Could not do POST";
        }
    }


    public function updateUser($id, $name, $email){
        return $this->userRepo->updateUser($id, $name, $email);
    }
    public function deleteUser($id){
        return $this->userRepo->deleteUser($id);
    }

    public function logUserIn(string $email, string $password)
    {
        require_once '../model/user.php';
        $user = $this->userRepo->getUserByEmail($email);
        $savedPassword = $user->password;

        if (!password_verify($password, $savedPassword)) {
            $user = null;
        }

        return $user;

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


    public function resetUserPassword($id, $newPassword)
    {
        return $this->userRepo->resetUserPassword($id, $newPassword);
    }


}