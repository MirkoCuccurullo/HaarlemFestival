<?php
require_once __DIR__ . '/../service/restaurantService.php';
require_once __DIR__ . '/../model/restaurant.php';
require_once __DIR__ . '/../model/session.php';


class restaurantController
{
    private restaurantService $restaurantService;

    public function __construct()
    {
        $this->restaurantService = new restaurantService();
    }

    public function displayFoodPage(): void
    {
        $restaurants = $this->restaurantService->getAllRestaurants();
        require __DIR__ . '/../view/yummy/yummy_homepage.php';
    }

    public function manageSessions(): void
    {
        require __DIR__ . '/../view/management/manageSessions.php';
    }


    public function manageRestaurants(): void
    {
        require __DIR__ . '/../view/management/manageRestaurants.php';
    }

    public function displayFormRestaurant(): void
    {
        require __DIR__ . '/../view/management/addRestaurant.php';
    }

    public function addRestaurant(): void
    {
        $this->restaurantService->addRestaurant($_POST['name'], $_POST['description'], $_POST['address'], $_POST['cuisines'], $_POST['dietary'], $_POST['photo']);
        header('Location: /manage/restaurant');
    }

    public function editRestaurant(): void
    {
        $restaurant = $this->restaurantService->getRestaurantByID($_POST['id']);
        require __DIR__ . '/../view/management/editRestaurant.php';
    }

    public function updateRestaurant(): void
    {
        $this->restaurantService->updateRestaurant($_POST['id'], $_POST['name'], $_POST['description'], $_POST['address'], $_POST['cuisines'], $_POST['dietary'], $_POST['photo']);
        header('Location: /manage/restaurant');
    }

    public function editSession(): void
    {
        $session = $this->restaurantService->getSessionById($_POST['id']);
        require __DIR__ . '/../view/management/editSession.php';
    }

    public function updateSession(): void
    {
        $this->restaurantService->updateSession($_POST['id'], $_POST['startTime'], $_POST['endTime'], $_POST['date'], $_POST['capacity'], $_POST['reservationPrice'], $_POST['sessionPrice'], $_POST['reducedPrice'], $_POST['restaurantId']);
        header('Location: /manage/session');

    }


    public function addSession(): void
    {
        $this->restaurantService->addSession($_POST['startTime'], $_POST['endTime'], $_POST['date'], $_POST['capacity'], $_POST['reservationPrice'], $_POST['sessionPrice'], $_POST['reducedPrice'], $_POST['restaurantId']);
        header('Location: /manage/session');
    }

    public function displayFormSession(): void
    {
        require __DIR__ . '/../view/management/addSession.php';
    }

}