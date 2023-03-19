<?php

require_once '../repository/userRepository.php';
class userService{
    private $userRepo;
    public function __construct(){
        $this->userRepo = new userRepository();
    }
    public function getUserById($id){
        return $this->userRepo->getUser($id);
    }

    public function getAllUsers(){
        return $this->userRepo->getAllUsers();
    }
    public function registerUser(array $data)
    {
        $preparedData = $this->prepareData($data);
        $hashedSaltedPassword = password_hash($preparedData['password'], PASSWORD_DEFAULT);
        $this->userRepo->insertUserToDatabase($preparedData['name'], $preparedData['email'], $hashedSaltedPassword, $preparedData['date_of_birth']);
    }

    public function isEmailAlreadyInUse(string $email): bool
    {
        return $this->userRepo->isEmailAlreadyInUse($email);
    }

    public function verifyCaptchaResponse($response) {
        $secretKey = "6Lf1GqQkAAAAAIHXMnwYENEaoqgabLaD-Zy1As9E";
        $remoteIp = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp";
        $data = file_get_contents($url);
        $row = json_decode($data, true);

        return $row['success'];
    }

    public function dateInPast() : bool {
        $date = $_POST['date_of_birth'];
        $date = strtotime($date);
        $date = date('Y-m-d', $date);
        $today = date('Y-m-d');
        if ($date > $today) {
            return false;
        }
        return true;
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

    public function getUserByEmail($email)
    {
        return $this->userRepo->getUserByEmail($email);
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

    public function checkUsernamePassword($email, $password)
    {
        return $this->userRepo->checkUsernamePassword($email, $password);
    }
}