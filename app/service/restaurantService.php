<?php
require_once __DIR__ . '/../repository/restaurantRepository.php';
require_once __DIR__ . '/../model/restaurant.php';

class restaurantService
{
    private restaurantRepository $restaurantRepository;

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

    public function addRestaurant($name, $description, $address, $cuisines, $dietary, $photo): void
    {
        $id =null;
        $restaurant=$this->setRestaurant($id, $name, $description, $address, $cuisines, $dietary, $photo);
        $this->restaurantRepository->addRestaurant($restaurant);
    }
    public function getRestaurantByID(int $id)
    {
        return $this->restaurantRepository->getRestaurantByID($id);
    }

    public function updateRestaurant($id, $name, $description, $address, $cuisines, $dietary, $photo): void
    {
        $restaurant=$this->setRestaurant($id, $name, $description, $address, $cuisines, $dietary, $photo);
        $this->restaurantRepository->updateRestaurant($restaurant);
    }
    private function setRestaurant($id, $name, $description, $address, $cuisines, $dietary, $photo): restaurant
    {
        $restaurant = new restaurant();
        if (isset($id)) {
            $restaurant->id = $id;
        }
        $restaurant->name = $name;
        $restaurant->description = $description;
        $restaurant->address = $address;
        $restaurant->cuisines = $cuisines;
        $restaurant->dietary = $dietary;
        $restaurant->photo = $photo;
        return $restaurant;
    }

    public function deleteRestaurant(int $id): void
    {
        $this->restaurantRepository->deleteRestaurant($id);
    }

    public function updateSession($id, $startTime, $endTime, $date, $capacity, $reservationPrice, $sessionPrice,$reducedPrice, $restaurantId): void
    {
        $session=$this->setSession($id, $startTime, $endTime,$date, $capacity, $reservationPrice, $sessionPrice,$reducedPrice, $restaurantId);
        $this->restaurantRepository->updateSession($session);
    }

    private function setSession( $id, $startTime, $endTime, $date, $capacity, $reservationPrice, $sessionPrice,$reducedPrice, $restaurantId): session
    {
        $session = new session();
        if (isset($id)) {
            $session->id = $id;
        }
        $session->startTime = $startTime;
        $session->endTime = $endTime;
        $session->date = $date;
        $session->capacity = $capacity;
        $session->reservationPrice = $reservationPrice;
        $session->sessionPrice = $sessionPrice;
        $session->reducedPrice = $reducedPrice;
        $session->restaurantId = $restaurantId;
        return $session;
    }

    public function deleteSession(int $id): void
    {
        $this->restaurantRepository->deleteSession($id);
    }

    public function addSession($startTime, $endTime, $date, $capacity, $reservationPrice, $sessionPrice, $reducedPrice, $restaurantId): void
    {
        $session=$this->setSession(null, $startTime, $endTime, $date, $capacity, $reservationPrice, $sessionPrice,$reducedPrice, $restaurantId);
        $this->restaurantRepository->addSession($session);
    }


    public function getSessionById($id)
    {
        return $this->restaurantRepository->getSessionById($id);
    }

}

}

    public function getAllSessions()
    {
        return $this->restaurantRepository->getAllSessions();
    }
}

