<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/event.php';
class restaurant extends event{
    public string $address;
    public array $sessions;
    public string $cuisines;
    public string $dietary;
    public string $image;
}