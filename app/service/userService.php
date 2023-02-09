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
    public function createUser($user){
        return $this->userRepo->createUser($user);
    }
    public function updateUser($user){
        return $this->userRepo->updateUser($user);
    }
    public function deleteUser($id){
        return $this->userRepo->deleteUser($id);
    }

    public function logUserIn(string $email, string $password)
    {
        $user = $this->userRepo->getUserByEmail($email);
        $savedPassword = $user->getPassword();

        if(!password_verify($password, $savedPassword)){
            $user = null;
        }

        return $user;
    }

}