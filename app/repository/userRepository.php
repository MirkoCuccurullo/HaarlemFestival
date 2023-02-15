<?php

use repository\baseRepository;

require_once '../model/user.php';
include_once 'baseRepository.php';
class userRepository extends baseRepository
{

    public function getUser($id)
    {
        //change star to field names once we know what they are
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function insertUserToDatabase($name, $email, $hashedSaltedPassword, $date_of_birth): bool
    {
        $sql = "INSERT INTO users (name, email, password, date_of_birth, registration_date, role) VALUES (:name, :email, :hashedSaltedPassword, :date_of_birth, now(), :role)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $role = " ";
        $stmt->bindParam(":role", $role);
        $stmt->bindParam(":hashedSaltedPassword", $hashedSaltedPassword);
        $stmt->bindParam(":date_of_birth", $date_of_birth);
        return $stmt->execute();
    }
    public function updateUser($id, $name, $email)
    {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function getUserByEmail(string $email)
    {
        //change star to field names once we know what they are
        $sql = "SELECT id, email, password, picture, registration_date, role, date_of_birth, name FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':email' => $email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'user');
        $result = $stmt->fetch();
        return $result;
    }


    public function resetUserPassword($id, $newPassword)
    {
        $sql = "UPDATE users SET password = :newPassword WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['newPassword' => $newPassword, 'id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}