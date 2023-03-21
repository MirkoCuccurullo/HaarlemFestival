<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/event.php';
class restaurant {

    public int $id;
    public string $name;
    public string $address;
    public array $sessions;

    public string $description;
    public string $cuisines;
    public string $dietary;
    public string $photo;

}