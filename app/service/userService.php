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
    public function updateUser($id, $name, $email){
        return $this->userRepo->updateUser($id, $name, $email);
    }
    public function deleteUser($id){
        return $this->userRepo->deleteUser($id);
    }

    public function resetUserPassword($id, $newPassword)
    {
        return $this->userRepo->resetUserPassword($id, $newPassword);
    }

}