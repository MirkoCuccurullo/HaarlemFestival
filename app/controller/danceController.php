<?php

class danceController
{
    public function homepage(){
        require"../view/dance/dance_homepage.php";
    }

    public function addEvent()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->insertEvent($_POST['date'], $_POST['location'], $_POST['artist'], $_POST['price'], $_POST['start_time'],$_POST['end_time']);
        header('Location: /festival/dance');
    }

    public function manageAllEvents()
    {
        require __DIR__ . '/../view/management/manageEvents.php';
    }

    public function displayForm()
    {
        require_once __DIR__ . '/../view/management/addDanceEvent.php';
    }

    public function manageArtists()
    {
        require __DIR__ . '/../view/management/manageArtists.php';
    }

    public function manageVenues()
    {
        require __DIR__ . '/../view/management/manageVenues.php';
    }
}