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

    public function addRestaurant(mixed $name, mixed $description, mixed $address, mixed $cuisines, mixed $dietary, mixed $photo): void
    {
        $restaurant=$this->setRestaurant(null, $name, $description, $address, $cuisines, $dietary, $photo);
        $this->restaurantRepository->addRestaurant($restaurant);
    }
    public function getRestaurantByID(int $id)
    {
        return $this->restaurantRepository->getRestaurantByID($id);
    }

    public function updateRestaurant(mixed $id, mixed $name, mixed $description, mixed $address, mixed $cuisines, mixed $dietary, mixed $photo): void
    {
        $restaurant=$this->setRestaurant($id, $name, $description, $address, $cuisines, $dietary, $photo);
        $this->restaurantRepository->updateRestaurant($restaurant);
    }
    private function setRestaurant(mixed $id, mixed $name, mixed $description, mixed $address, mixed $cuisines, mixed $dietary, mixed $photo): restaurant
    {
        $restaurant = new restaurant();
        $restaurant->id = $id;
        $restaurant->name = $name;
        $restaurant->description = $description;
        $restaurant->address = $address;
        $restaurant->cuisines = $cuisines;
        $restaurant->dietary = $dietary;
        $restaurant->photo = $photo;
        return $restaurant;
    }

    public function deleteRestaurant(int $id)
    {
        $this->restaurantRepository->deleteRestaurant($id);
    }

    public function updateSession(mixed $id, mixed $startTime, mixed $endTime, mixed $capacity, mixed $reservationPrice, mixed $sessionPrice, mixed $restaurantId)
    {
        $session=$this->setSession($id, $startTime, $endTime, $capacity, $reservationPrice, $sessionPrice, $restaurantId);
        $this->restaurantRepository->updateSession($session);
    }

    private function setSession(mixed $id, mixed $startTime, mixed $endTime, mixed $capacity, mixed $reservationPrice, mixed $sessionPrice, mixed $restaurantId): session
    {
        $session = new session();
        $session->id = $id;
        $session->startTime = $startTime;
        $session->endTime = $endTime;
        $session->capacity = $capacity;
        $session->reservationPrice = $reservationPrice;
        $session->sessionPrice = $sessionPrice;
        $session->restaurantId = $restaurantId;
        return $session;
    }

    public function deleteSession(int $id): void
    {
        $this->restaurantRepository->deleteSession($id);
    }
}