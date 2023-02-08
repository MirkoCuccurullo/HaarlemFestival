<?php

class RegistrationController
{
    public function addUser($user)
    {
        require_once('../repository/userRepository.php');
        $repo = new userRepository();
        $repo->addUser($user);
    }

    public function addLawyer($user)
    {
        require_once('../repository/lawyerRepository.php');
        $repo = new lawyerRepository();
        $repo->addLawyer($user);
    }

    public function showForm()
    {
        require("../view/home/registration.php");
    }

    public function showFormLawyer()
    {
        require("../view/home/add_lawyer.php");
    }
}