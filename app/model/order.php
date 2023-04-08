<?php

namespace Models;

require_once __DIR__ . '/../model/dance.php';
require_once __DIR__ . '/../model/accessPass.php';
require_once __DIR__ . '/../model/reservation.php';
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

    public function removeEvent($event){
        $this->no_of_items--;
        $this->total_price -= $event->price;
        $reversedEvents = array_reverse($this->events);
        $key = array_search($event, $reversedEvents);
        $lastKey = count($this->events) - $key - 1;
        unset($this->events[$lastKey]);
        $this->events = array_values($this->events);
    }

    public function removeEventByType($event){
        foreach ($this->events as $key => $value) {
            if ($value == $event) {
                $this->removeEvent($value);
            }
        }
        $this->events = array_values($this->events);
    }

    public function countForEvent($event){
        $count = 0;
        foreach($this->events as $e){
            if($e == $event){
                $count++;
            }
        }
        return $count;
    }

    public function priceForEvent($event){
        $price = 0;
        foreach($this->events as $e){
            if($e == $event){
                $price += $e->price;
            }
        }
        return $price;
    }

    public function getUniqueEvents(){
        $uniqueEvents = array();
        foreach($this->events as $event){
            if(!in_array($event, $uniqueEvents)){
                $uniqueEvents[] = $event;
            }
        }
        return $uniqueEvents;
    }
}
