<?php

use repository\baseRepository;
include __DIR__ . '/../repository/baseRepository.php';
require __DIR__ . '/../model/registration.php';

class registrationRepository extends baseRepository{

    public function insertUserToDatabase($name, $email, $hashedSaltedPassword, $date_of_birth): bool
    {
        $sql = "INSERT INTO users (name, email, password, date_of_birth, registration_date) VALUES (:name, :email, :hashedSaltedPassword, :date_of_birth, now())";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":hashedSaltedPassword", $hashedSaltedPassword);
        $stmt->bindParam(":date_of_birth", $date_of_birth);
        return $stmt->execute();
    }

    // call this method in some other method?
    public function emailInUse($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":email", $email);

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            echo "Email is already in use";
        }
    }

}
