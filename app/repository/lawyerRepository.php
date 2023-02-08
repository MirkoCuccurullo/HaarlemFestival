<?php

require_once("baseRepository.php");

class lawyerRepository extends baseRepository
{
    public function addLawyer($lawyer)
    {
        try {
            require_once("../model/lawyer.php");
            $stmt = $this->connection->prepare("INSERT INTO `employee` (`firstname`, `email`, `type`)
            VALUES (:firstname, :email, :type);");
            $stmt->bindParam(':firstname', $lawyer->firstname);
            $stmt->bindParam(':email', $lawyer->email);
            $stmt->bindParam(':type', $lawyer->area );
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }

    }


    public function getAllLawyers(){
        require_once("../model/lawyer.php");

        $stmt = $this->connection->prepare("select * from employee");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'lawyer');
        return $stmt->fetchAll();
    }


    public function getLawyerById($id){
        require_once("../model/lawyer.php");
        $stmt = $this->connection->prepare("SELECT * FROM employee WHERE employee_id=:id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'lawyer');
        return $stmt->fetch();
    }



    public function getLawArea(){
        require_once("../model/law_area.php");

        $stmt = $this->connection->prepare("select * from employee_type");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'law_area');
        return $stmt->fetchAll();
    }

    public function storeAccessToken($access_token, $lawyer_id, $refresh_token)
    {
        require_once("../model/lawyer.php");

        $stmt = $this->connection->prepare("UPDATE employee SET google_token=:token, google_refresh_token=:refresh_token WHERE id=:id");
        $stmt->bindParam(':token', $access_token);
        $stmt->bindParam(':refresh_token', $refresh_token);
        $stmt->bindParam(':id', $lawyer_id);
        return $stmt->execute();
    }

    public function lastId(){
        return $this->connection->lastInsertId();
}

}