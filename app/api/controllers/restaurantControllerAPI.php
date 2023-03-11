<?php
require_once __DIR__ . '/../../service/restaurantService.php';
require_once __DIR__ . '/../../model/restaurant.php';

class restaurantControllerAPI
{
    private restaurantService $restaurantService;

    function __construct()
    {
        $this->restaurantService = new restaurantService();
    }
    public function index(): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        // Respond to a GET request to /api/session
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $restaurants = $this->restaurantService->getRestaurantInfo();
            header('Content-Type: application/json');
            echo json_encode($restaurants);

        }
    }

    public function delete(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // your code here
            $body = file_get_contents('php://input');
            $obj = json_decode($body);
            $this->restaurantService->deleteRestaurant($obj->id);
        }
    }

}