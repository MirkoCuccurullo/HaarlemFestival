<?php
namespace Models;
require_once __DIR__ . '/../model/dance.php';
//add require for history event
class order{
    public int $id;
    public ?int $user_id;
    public int $no_of_items;
    public float $total_price;
    public string $status;
    public array $events = array();
    public ?string $payment_id;

    public function addEvent($danceEvent){
        $this->events[] = $danceEvent;
        $this->no_of_items++;
        $this->total_price += $danceEvent->price;
    }

    public function removeEvent($key){

        $this->no_of_items--;
        $this->total_price -= $this->events[$key]->price;
        unset($this->events[$key]);
        $this->events = array_values($this->events);
    }



    //properties

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int|null $user_id
     */
    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getNoOfItems(): int
    {
        return $this->no_of_items;
    }

    /**
     * @param int $no_of_items
     */
    public function setNoOfItems(int $no_of_items): void
    {
        $this->no_of_items = $no_of_items;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->total_price;
    }

    /**
     * @param float $total_price
     */
    public function setTotalPrice(float $total_price): void
    {
        $this->total_price = $total_price;
    }

    /**
     * @return string|null
     */
    public function getPaymentId(): ?string
    {
        return $this->payment_id;
    }

    /**
     * @param string|null $payment_id
     */
    public function setPaymentId(?string $payment_id): void
    {
        $this->payment_id = $payment_id;
    }


}
