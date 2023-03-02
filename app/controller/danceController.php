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

    public function displayForm()
    {
        require_once __DIR__ . '/../view/management/addDanceEvent.php';
    }
}