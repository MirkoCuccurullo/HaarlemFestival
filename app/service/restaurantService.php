<?php
require_once __DIR__ . '/../repository/restaurantRepository.php';

class restaurantService
{
    private $restaurantRepository;

    public function __construct()
    {
        $this->restaurantRepository = new restaurantRepository();
    }

    public function getRestaurantInfo(): array
    {
        return $this->restaurantRepository->getRestaurantInfo();
    }

    public function getAllSessions(): array
    {
        return $this->restaurantRepository->getAllSessions();
    }
}