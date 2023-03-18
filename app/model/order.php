<?php
namespace Models;
require_once __DIR__ . '/../model/dance.php';
class order{
    public int $id;
    public int $user_id;
    public int $no_of_items;
    public float $total_price;
    public $dance_events;

    public function __construct()
    {
//        $this->no_of_items = 0;
//        $this->total_price = 0;
        //$this->user_id = $_SESSION['current_user_id'];
        $this->dance_events = array();
    }

    public function addDanceEvent($danceEvent){
        $this->dance_events[] = $danceEvent;
        $this->no_of_items++;
        $this->total_price += $danceEvent->price;
    }

    public function removeDanceEvent($key){
        $this->no_of_items--;
        $this->total_price -= $this->dance_events[$key]->price;
        unset($this->dance_events[$key]);
        $this->dance_events = array_values($this->dance_events);
    }
}
