<?php

class danceController
{
    public function homepage()
    {
        require_once __DIR__ . '/../model/dance.php';
        require_once __DIR__ . '/../model/venues.php';
        require_once __DIR__ . '/../model/artist.php';
        require_once __DIR__ . '/../service/eventService.php';

        $eventService = new EventService();
        $events = $eventService->getAllEvents();
        $venues = $eventService->getVenues();
        $artists = $eventService->getArtists();
        require "../view/dance/dance_homepage.php";
    }

    public function addEvent()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->insertEvent(htmlspecialchars($_POST['date']), htmlspecialchars($_POST['location']), htmlspecialchars($_POST['artist']), htmlspecialchars($_POST['price']), htmlspecialchars($_POST['start_time']), htmlspecialchars($_POST['end_time']));
        header('Location: /festival/dance');
    }

    public function manageAllEvents()
    {
        if (isset($_SESSION['current_user']) && $_SESSION['current_user']->role == '3')
            require __DIR__ . '/../view/management/manageEvents.php';
        else
            header('Location: /festival/dance');
    }

    public function displayFormEvent()
    {
        if (isset($_SESSION['current_user']) && $_SESSION['current_user']->role == '3') {
            require_once __DIR__ . '/../model/artist.php';
            require_once __DIR__ . '/../service/eventService.php';
            require_once __DIR__ . '/../model/venues.php';
            $eventService = new eventService();
            $artists = $eventService->getArtists();
            $locations = $eventService->getVenues();
            require_once __DIR__ . '/../view/management/addDanceEvent.php';
        } else
            header('Location: /festival/dance');
    }

    public function manageArtists()
    {
        if (isset($_SESSION['current_user']) && $_SESSION['current_user']->role == '3')
            require __DIR__ . '/../view/management/manageArtists.php';
        else
            header('Location: /festival/dance');
    }

    public function manageVenues()
    {
        if (isset($_SESSION['current_user']) && $_SESSION['current_user']->role == '3')
            require __DIR__ . '/../view/management/manageVenues.php';
        else
            header('Location: /festival/dance');
    }

    public function editArtist()
    {
        if (isset($_POST['id'])) {
            require_once __DIR__ . '/../service/eventService.php';
            $danceService = new eventService();
            $artist = $danceService->getArtistByID(htmlspecialchars($_POST['id']));
            require __DIR__ . '/../view/management/editArtist.php';
        } else {
            header('Location: /festival/dance');
        }
    }

    public function updateArtist()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $picture_name = '';
        if (isset($_FILES['picture'])) {
            $picture_name = '/images/' . $_FILES['picture']['name'];
            //upload picture to public/images
            $target_dir = __DIR__ . "/../public/images/";
            $target_file = $target_dir . basename($_FILES["picture"]["name"]);
            move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
        } else {
            $picture_name = $_POST['old_pic_path'];
        }

        $danceService->updateArtist(htmlspecialchars($_POST['id']), htmlspecialchars($_POST['name']), htmlspecialchars($_POST['genre']), htmlspecialchars($_POST['description']), $picture_name);
        header('Location: /manage/dance/artists');
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
        $picture_name = '';
        if (isset($_FILES['picture'])) {
            $picture_name = '/images/' . $_FILES['picture']['name'];
            //upload picture to public/images
            $target_dir = __DIR__ . "/../public/images/";
            $target_file = $target_dir . basename($_FILES["picture"]["name"]);
            move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
        } else {
            $picture_name = $_POST['old_pic_path'];
        }
        $danceService->updateVenue(htmlspecialchars($_POST['id']), htmlspecialchars($_POST['name']), htmlspecialchars($_POST['address']), htmlspecialchars($_POST['description']), htmlspecialchars($_POST['capacity']), htmlspecialchars($picture_name));
        header('Location: /festival/dance/manageVenues');
    }

    public function editEvent()
    {
        if (isset($_POST['id'])) {
            require_once __DIR__ . '/../service/eventService.php';
            require_once __DIR__ . '/../model/artist.php';
            require_once __DIR__ . '/../service/eventService.php';
            require_once __DIR__ . '/../model/venues.php';
            $danceService = new eventService();
            $event = $danceService->getEventByID(htmlspecialchars($_POST['id']));
            $artists = $danceService->getArtists();
            $locations = $danceService->getVenues();
            require __DIR__ . '/../view/management/editEvent.php';
        } else
            header('Location: /festival/dance');
    }

    public function updateEvent()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $danceService->updateEvent(htmlspecialchars($_POST['id']), htmlspecialchars($_POST['date']), htmlspecialchars($_POST['location']), htmlspecialchars($_POST['artist']), htmlspecialchars($_POST['price']), htmlspecialchars($_POST['start_time']), htmlspecialchars($_POST['end_time']));
        header('Location: /festival/dance/manageAllEvents');
    }

    public function displayFormArtist()
    {
        if (isset($_SESSION['current_user']) && $_SESSION['current_user']->role == '3')
            require __DIR__ . '/../view/management/addArtist.php';
        else
            header('Location: /festival/dance');
    }

    public function addArtist()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();

        $picture_name = '/images/' . $_FILES['picture']['name'];
        //upload picture to public/images
        $target_dir = __DIR__ . "/../public/images/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
        $danceService->insertArtist(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['genre']), htmlspecialchars($_POST['description']), htmlspecialchars($picture_name), htmlspecialchars($_POST['spotify']));
        header('Location: /manage/dance/artists');
    }

    public function displayFormVenue()
    {
        if (isset($_SESSION['current_user']) && $_SESSION['current_user']->role == '3')
            require __DIR__ . '/../view/management/addVenue.php';
        else
            header('Location: /festival/dance');
    }

    public function addVenue()
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $picture_name = '/images/' . $_FILES['picture']['name'];
        //upload picture to public/images
        $target_dir = __DIR__ . "/../public/images/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
        $danceService->insertVenue(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['address']), htmlspecialchars($_POST['description']), htmlspecialchars($_POST['capacity']), htmlspecialchars($picture_name));
    }

    public function displayArtist($id)
    {
        require_once __DIR__ . '/../service/eventService.php';
        $danceService = new eventService();
        $artist = $danceService->getArtistByID(htmlspecialchars($id));
        require __DIR__ . '/../view/dance/dance_artist.php';
    }
}