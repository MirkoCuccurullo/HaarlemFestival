<?php

class danceController
{
    public function homepage(){
        require_once __DIR__ . '/../model/dance.php';
        require_once __DIR__ . '/../model/venues.php';
        require_once __DIR__ . '/../model/artist.php';
        require_once __DIR__ . '/../service/eventService.php';

        $eventService = new EventService();
        $events = $eventService->getAllEvents();
        $venues = $eventService->getVenues();
        $artists = $eventService->getArtists();
        require"../view/dance/dance_homepage.php";
    }

    public function addEvent()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->insertEvent(htmlspecialchars($_POST['date']), htmlspecialchars($_POST['location']), htmlspecialchars($_POST['artist']), htmlspecialchars($_POST['price']), htmlspecialchars($_POST['start_time']),htmlspecialchars($_POST['end_time']));
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
        $artist = $danceService->getArtistByID(htmlspecialchars($_POST['id']));
        require __DIR__ . '/../view/management/editArtist.php';
    }

    public function updateArtist()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->updateArtist(htmlspecialchars($_POST['id']), htmlspecialchars($_POST['name']), htmlspecialchars($_POST['genre']), htmlspecialchars($_POST['description']));
        header('Location: /festival/dance/manageArtists');
    }

    public function editVenue()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $venue = $danceService->getVenueByID(htmlspecialchars($_POST['id']));
        require __DIR__ . '/../view/management/editVenue.php';
    }

    public function updateVenue()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->updateVenue(htmlspecialchars($_POST['id']), htmlspecialchars($_POST['name']), htmlspecialchars($_POST['address']), htmlspecialchars($_POST['description']), htmlspecialchars($_POST['capacity']));
        header('Location: /festival/dance/manageVenues');
    }

    public function editEvent()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $event = $danceService->getEventByID(htmlspecialchars($_POST['id']));
        require __DIR__ . '/../view/management/editEvent.php';
    }

    public function updateEvent()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->updateEvent(htmlspecialchars($_POST['id']), htmlspecialchars($_POST['date']), htmlspecialchars($_POST['location']), htmlspecialchars($_POST['artist']), htmlspecialchars($_POST['price']), htmlspecialchars($_POST['start_time']),htmlspecialchars($_POST['end_time']));
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
        $danceService->insertArtist(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['genre']), htmlspecialchars($_POST['description']), htmlspecialchars($_POST['picture']), htmlspecialchars($_POST['spotify']));
        header('Location: /manage/dance/artists');
    }

    public function displayFormVenue()
    {
        require __DIR__ . '/../view/management/addVenue.php';
    }

    public function addVenue()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->insertVenue(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['address']), htmlspecialchars($_POST['description']), htmlspecialchars($_POST['capacity']), htmlspecialchars($_POST['picture']));
    }

    public function displayArtist()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $artist = $danceService->getArtistByID(htmlspecialchars($_POST['id']));
        require __DIR__ . '/../view/dance/dance_artist.php';
    }
}