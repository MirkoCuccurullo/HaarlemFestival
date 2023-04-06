<?php
namespace Models;
require_once __DIR__ . '/../model/dance.php';
class order{
    public int $id;
    public ?int $user_id;
    public int $no_of_items;
    public float $total_price;
    public $events = array();
    public string $status;
    public ?string $payment_id;

    public function addEvent($event){
        $this->events[] = $event;
        $this->no_of_items++;
        $this->total_price += $event->price;
    }

    public function removeEvent($key){

        $this->no_of_items--;
        $this->total_price -= $this->events[$key]->price;
        unset($this->events[$key]);
        $this->events = array_values($this->events);
    }
}
