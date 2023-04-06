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

    //setting properties for invoice
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setNoOfItems($no_of_items) {
        $this->no_of_items = $no_of_items;
    }

    public function setTotalPrice($total_price) {
        $this->total_price = $total_price;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}
