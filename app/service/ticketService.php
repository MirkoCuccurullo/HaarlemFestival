<?php

require_once '../repository/ticketRepository.php';

class ticketService{
    private $ticketRepo;
    public function __construct(){
        $this->ticketRepo = new ticketRepository();
    }
    public function createTicket($ticket){
        return $this->ticketRepo->createTicket($ticket);
    }
}