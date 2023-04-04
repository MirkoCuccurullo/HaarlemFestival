<?php

require_once '../repository/ticketRepository.php';

class ticketService{
    private $ticketRepo;
    public function __construct(){
        $this->ticketRepo = new ticketRepository();
    }
    public function insertTicket($ticket){
        return $this->ticketRepo->insertTicket($ticket);
    }

    public function createTickets($order){
        $tickets = array();
        foreach($order->dance_events as $event){
            $ticket = new ticket();
            $ticket->dance_event_id = NULL;
            $ticket->yummy_event_id = NULL;
            $ticket->history_event_id = NULL;
            $ticket->access_pass_id = NULL;
            $ticket->quantity = 1;
            $ticket->price = $event->price;
            //$ticket->dance_event_id = $dance_event->id;
            $ticket->status = "Active";
            $ticket->order_id = $order->id;
            $ticket->user_id = $order->user_id;

            if($event instanceof dance){
                $ticket->dance_event_id = $event->id;
                $ticket->vat_id = 1;
            }
            else if($event instanceof accessPass){
                $ticket->access_pass_id = $event->id;
                $ticket->vat_id = 1;
            }
//            else if($event instanceof yummy){
//                $ticket->yummy_event_id = $event->id;
//                $ticket->vat_id = 2;
//            }
//            else if($event instanceof history){
//                $ticket->history_event_id = $event->id;
//                $ticket->vat_id = 2;
//            }
            $tickets[] = $ticket;
        }
        return $tickets;
    }


    public function getTicketById($id){
        return $this->ticketRepo->getTicketById($id);
    }

    public function getTicketsByOrderId($order_id){
        return $this->ticketRepo->getTicketsByOrderId($order_id);
    }

    public function scanTicket($ticket){
        return $this->ticketRepo->scanTicket($ticket);
    }
}