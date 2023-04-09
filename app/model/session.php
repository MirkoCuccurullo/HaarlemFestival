<?php

class session{

    public  int $id;
    public string $startTime;
    public string $endTime;
    public int $capacity;
    public float $reservationPrice;
    public float $sessionPrice;

    //for children under 12
    public float $reducedPrice;
    public int $restaurantId;
    public $date;

    public $spaces;

}