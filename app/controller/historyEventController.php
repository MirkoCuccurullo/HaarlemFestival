<?php

use router\router;

include_once __DIR__ . '/../model/historyPageCard.php';
include_once __DIR__ . '/../model/historyPageContent.php';
require_once __DIR__ . '/../service/historyEventService.php';

class historyEventController
{
    private $historyEventService;

    public function __construct()
    {
        $this->historyEventService = new historyEventService();
    }

    public function historyMainPage()
    {
        $locations = $this->historyEventService->getAllHistoryCard();
        $content = $this->historyEventService->getHistoryPageContent();
        $historyTourTimetable = $this->historyEventService->getHistoryTourTimetable();

        include __DIR__ . '/../view/historyHeader.php';
        require __DIR__ . "/../view/history/history.php";
    }

    public function historyCartPage($id){
        $ticketById = $this->historyEventService->getHistoryTicketById($id);

        require __DIR__ . '/../view/history/historyCart.php';
    }
    public function historyLocationDetailPage($id) {
        $locationDetailById = $this->historyEventService->getLocationDetailById($id);

        require __DIR__ . '/../view/history/historyLocationDetail.php';
    }
}