<?php

namespace repository;

use apiKey;

require_once __DIR__ . '/../model/apiKey.php';
require_once __DIR__ . '/baseRepository.php';


class apiKeyRepository extends baseRepository
{

    public function getAllApiKeys()
    {
        $query = "SELECT apikey.id,apikey.key,apikey.used_by,apikey.purpose, apikey.created_on FROM apikey ";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            $apiKeys = array();
            foreach ($result as $row) {
                $apiKeys[] = new ApiKey($row['apiKeyId'], $row['key'], $row['UsedBy'], $row['purpose'], $row['createdOn']);
            }
            return $apiKeys;
        }
        return null;
    }

    public function checkApiKeyExistenceInDb($key): bool
    {
        $sql = "SELECT apikey.id FROM apikey WHERE apikey.key = :key";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":key", $key);
        $stmt->execute();
        $result = $stmt->fetch();
        if (!empty($result)) {
            return true;
        }
        return false;
    }

    public function createApiKey($data)
    {
        $query = "INSERT INTO apikey (`key`,used_by,purpose) VALUES (:key,:usedBy,:purpose)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":key", $data['key']);
        $stmt->bindParam(":usedBy", $data['usedBy']);
        $stmt->bindParam(":purpose", $data['purpose']);
        $stmt->execute();
        $result = $this->getById($this->connection->lastInsertId());

        // since it is a insert query, it will return bool
        return $result;
    }
    public function getById($id){
        $query = "SELECT apikey.id,apikey.key,apikey.used_by,apikey.purpose, apikey.created_on FROM apikey WHERE apikey.id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        if (!empty($result)) {
            return new ApiKey($result['id'], $result['key'], $result['used_by'], $result['purpose'], $result['created_on']);
        }
        return null;
    }

    public function checkExistenceOfAPiKey($usedBy,$purpose): bool
    {
        $query = "SELECT apikey.id FROM apikey WHERE apikey.used_by = :usedBy and apikey.purpose = :purpose";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":usedBy", $usedBy);
        $stmt->bindParam(":purpose", $purpose);
        $stmt->execute();
        $result = $stmt->fetch();
        if (!empty($result)) {
            return true;
        }
        return false;
    }


}