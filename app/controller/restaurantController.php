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
        $restaurantInfo = $this->restaurantService->getRestaurantInfo();
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

    public function displayFormRestaurant()
    {
        require __DIR__ . '/../view/management/addRestaurant.php';
    }
    public function addRestaurant(): void
    {
        $this->restaurantService->addRestaurant($_POST['name'], $_POST['description'], $_POST['address'], $_POST['cuisines'], $_POST['dietary'],$_POST['photo']);
        header('Location: /festival/yummy');
    }
    public function editRestaurant(): void
    {
        $this->restaurantService->getRestaurantByID($_POST['id']);
        require __DIR__ . '/../view/management/editRestaurant.php';
    }
    public function updateRestaurant(): void
    {
        $this->restaurantService->updateRestaurant($_POST['id'], $_POST['name'], $_POST['description'], $_POST['address'], $_POST['cuisines'], $_POST['dietary'],$_POST['photo']);
        header('Location: /festival/yummy');
    }

    public function editSession(): void
    {
        $this->restaurantService->getAllSessions();
        require __DIR__ . '/../view/management/editSession.php';
    }
    public function updateSession(): void
    {
        $this->restaurantService->updateSession($_POST['id'], $_POST['startTime'], $_POST['endTime'], $_POST['capacity'], $_POST['reservationPrice'], $_POST['sessionPrice'],$_POST['restaurantId']);
        header('Location: /festival/yummy');
    }
   public function addSession(): void
   {
         $this->restaurantService->addSession($_POST['startTime'], $_POST['endTime'], $_POST['capacity'], $_POST['reservationPrice'], $_POST['sessionPrice'],$_POST['restaurantId']);
         header('Location: /festival/yummy');
    }
     public function deleteRestaurant(): void
     {
          $this->restaurantService->deleteRestaurant($_POST['id']);
          header('Location: /festival/yummy');
     }
     public function deleteSession()
     {
          $this->restaurantService->deleteSession($_POST['id']);
          header('Location: /festival/yummy');
     }
     public function displayFormSession()
     {
          require __DIR__ . '/../view/management/addSession.php';
     }


}