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
    public function createUser($user)
    {
        //need to add role to user depending on how we decide to do that
        $sql = "INSERT INTO users (name, email, password, registrationDate, dateOfBirth) VALUES (:name, :email, :password)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['name' => $user->name, 'email' => $user->email, 'password' => $user->password, 'registrationDate' => $user->registrationDate, 'dateOfBirth' => $user->dateOfBirth]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
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
        $sql = "SELECT name, password, registrationDate, dateOfBirth, role FROM users";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function getUserByEmail(string $email)
    {
        //change star to field names once we know what they are
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':email' => $email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'user');
        $result = $stmt->fetch();

    public function resetUserPassword($id, $newPassword)
    {
        $sql = "UPDATE users SET password = :newPassword WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['newPassword' => $newPassword, 'id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}