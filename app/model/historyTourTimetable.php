<?php

class historyTourTimetable {
    public int $id;
    public string $dateAndDay;
    public string $time;
    public string $language;
    public int $ticketAmount;
    public float $price;

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }


}