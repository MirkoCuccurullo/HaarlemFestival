<?php

class reservation {
    public int $id;
    public string $restaurantName;

    public int $sessionId;
    public string $status;
    public int $numberOfAdults;
    public int $numberOfUnder12;
    public float $price;
    public string $customerName;
    public string $customerEmail;
    public string $comment;

    public function displayReservation($reservation)
    {
            $pass = "Reservation at" . ($reservation->restaurantName);

        return $pass;

    }
}