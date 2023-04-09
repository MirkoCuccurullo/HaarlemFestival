<?php

use router\router;

require_once __DIR__ . '/../../service/ticketService.php';
require_once __DIR__ . '/../../model/ticket.php';
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../../router/router.php';

class ticketControllerAPI extends controller
{
    private $ticketService;

    // initialize services
    function __construct()
    {
        $this->ticketService = new ticketService();
    }

    public function scanTicket($id)
    {
        $ticket = $this->ticketService->getTicketById($id);
        if (!$ticket) {
            $this->respondWithError(404, "Ticket not found");
            return;
        }

        if($this->ticketService->scanTicket($ticket))
        {
            $this->respond($ticket);
        }
        else
        {
            $this->respondWithError(500, "Ticket already scanned.");
        }
    }

    public function getSoldDanceTickets($id)
    {
        try {
            $tickets = $this->ticketService->noOfTicketsForDanceEvent($id);
            $this->respond($tickets);
        }
        catch (Exception $e) {
            $this->respondWithError(500, "Something went wrong");
        }

    }
}