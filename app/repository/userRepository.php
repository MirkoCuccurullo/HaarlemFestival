<?php

include_once('baseRepository.php');

class userRepository extends baseRepository
{
    public function addUser($user)
    {
        try {
            require_once("../model/administrator.php");
            $stmt = $this->connection->prepare("INSERT INTO user (`firstname`, `email`, `password`) VALUES (:firstname, :email, :password)");
            $stmt->bindParam(':firstname', $user->firstname);
            $stmt->bindParam(':email', $user->email);
            $hashed_pass = password_hash($user->password, PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $hashed_pass);
            $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }

    }

    public function validateLogin($email, $password)
    {
        require_once("../model/administrator.php");

        $stmt = $this->connection->prepare("SELECT * FROM `user` where email=:email;");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'administrator');
        $user = $stmt->fetch();

        if ($user == null) {
            return null;
        }

        $bool = password_verify($password, $user->password);

        if ($bool) {
            return $user;
        } else {
            return null;
        }
    }
}