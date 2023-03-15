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

    public function displayFormEvent()
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

    public function editArtist()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $artist = $danceService->getArtistByID($_POST['id']);
        require __DIR__ . '/../view/management/editArtist.php';
    }

    public function updateArtist()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->updateArtist($_POST['id'], $_POST['name'], $_POST['genre'], $_POST['description']);
        header('Location: /festival/dance/manageArtists');
    }

    public function editVenue()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $venue = $danceService->getVenueByID($_POST['id']);
        require __DIR__ . '/../view/management/editVenue.php';
    }

    public function updateVenue()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->updateVenue($_POST['id'], $_POST['name'], $_POST['address'], $_POST['description'], $_POST['capacity']);
        header('Location: /festival/dance/manageVenues');
    }

    public function editEvent()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $event = $danceService->getEventByID($_POST['id']);
        require __DIR__ . '/../view/management/editEvent.php';
    }

    public function updateEvent()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->updateEvent($_POST['id'], $_POST['date'], $_POST['location'], $_POST['artist'], $_POST['price'], $_POST['start_time'],$_POST['end_time']);
        header('Location: /festival/dance/manageAllEvents');
    }

    public function displayFormArtist()
    {
        require __DIR__ . '/../view/management/addArtist.php';
    }

    public function addArtist()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->insertArtist($_POST['name'], $_POST['genre'], $_POST['description'], $_POST['picture'], $_POST['spotify']);
        header('Location: /festival/dance/manageArtists');
    }

    public function displayFormVenue()
    {
        require __DIR__ . '/../view/management/addVenue.php';
    }

    public function addVenue()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->insertVenue($_POST['name'], $_POST['address'], $_POST['description'], $_POST['capacity'], $_POST['picture']);
        header('Location: /festival/dance/manageVenues');
    }

    public function displayArtist()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $artist = $danceService->getArtistByID($_POST['id']);
        require __DIR__ . '/../view/dance/dance_artist.php';
    }
}