<?php

class reservation {
    public int $id;
    public string $restaurantName;

    public session $session;
    public int $status;
    //0: confirmed, 1: cancelled, 2: deactivated
    public int $numberOfAdults;
    public int $numberOfUnder12;
    public float $reservationPrice;
    public string $customerEmail;
    public string $comment;
}