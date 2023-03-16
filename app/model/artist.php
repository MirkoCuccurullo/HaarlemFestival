<?php

class artist
{
public int $id;
public string $name;
public string $picture;
public string $description;
public string $genre;
public string $spotify;

public function getScheduledEvents()
{
    require_once __DIR__ . '/../service/eventService.php';
    $danceService = new eventService();
    return $danceService->getEventsByArtist($this->id);
}
}