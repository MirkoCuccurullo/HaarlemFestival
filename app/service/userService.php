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
        //PASSWORD_DEFAULT, will automatically use the strongest algorithm available in the PHP version being used
        $hashedSaltedPassword = password_hash($preparedData['password'], PASSWORD_DEFAULT);
        $this->userRepo->insertUserToDatabase($preparedData['name'], $preparedData['email'], $hashedSaltedPassword, $preparedData['date_of_birth']);
    }

    public function isEmailAlreadyInUse(string $email): bool
    {
        return $this->userRepo->isEmailAlreadyInUse($email);
    }

    public function verifyCaptchaResponse($response) {
        $secretKey = "6Lf1GqQkAAAAAIHXMnwYENEaoqgabLaD-Zy1As9E";
        //ip sent to google to verify to ensure user is not a bot
        $remoteIp = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp";
        /* sends a GET request to the URL, retrieves content of a file as a string
        In this case, the URL points to Google reCAPTCHA API server and includes the
        necessary parameters ($secretKey,$response,$remoteIp) to verify user's response to the CAPTCHA challenge.
        The API server responds with a JSON string containing verification result, which is stored in $data */
        $data = file_get_contents($url);
        //returns associative array instead of an object
        $row = json_decode($data, true);

        return $row['success'];
    }

    public function dateInPast() : bool {
        $date = $_POST['date_of_birth'];
        // string date to UNIX

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

    // RETURNS AN ASSOCIATIVE ARRAY !!!!
    // The method takes an array of data as input, and then uses htmlspecialchars to escape any special characters in data
    // The method then returns an array with the sanitized data
    private function prepareData(array $data): array
    {
        // => sign, is used in associative arrays to assign a key to a value
        return [
            // 'name' is just a string that is used as a key in the associative array
            // $data array contains the form data that was submitted via POST request.
            // $data['name'] is the value that is assigned to the key 'name'
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