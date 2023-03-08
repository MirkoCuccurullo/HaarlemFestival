<?php
require_once __DIR__ . '/../service/restaurantService.php';
require_once __DIR__ . '/../model/restaurant.php';

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
}