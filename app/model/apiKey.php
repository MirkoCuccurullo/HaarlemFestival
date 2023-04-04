<?php

class apiKey
{
    public function __construct($id, $key, $usedBy, $purpose, $createdOn)
    {
        $this->id = $id;
        $this->key = $key;
        $this->used_by = $usedBy;
        $this->purpose = $purpose;
        $this->created_on = $createdOn;
    }

    public int $id;
    public string $key;
    public string $used_by;
    public string $purpose;
    public string $created_on;

}