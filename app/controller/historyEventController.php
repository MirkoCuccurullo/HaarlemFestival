<?php

use router\router;

include_once __DIR__ . '/../model/historyPageCard.php';
include_once __DIR__ . '/../model/historyPageContent.php';
include_once __DIR__ . '/../model/historyTourTimetable.php';
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

        include __DIR__ . '/../view/header_history.php';
        require __DIR__ . "/../view/history/history.php";
        include __DIR__ . '/../view/footer_history.php';

    }

    public function historyCartPage($id){
        $ticketById = $this->historyEventService->getHistoryTicketById($id);
        include __DIR__ . '/../view/header_history.php';
        require __DIR__ . '/../view/history/historyCart.php';
        include __DIR__ . '/../view/footer_history.php';

    }
    public function historyLocationDetailPage($id) {
        $locationDetailById = $this->historyEventService->getLocationDetailById($id);
        include __DIR__ . '/../view/header_history.php';
        require __DIR__ . '/../view/history/historyLocationDetail.php';
        include __DIR__ . '/../view/footer_history.php';
    }

    public function historyManagement()
    {
        if (isset($_SESSION['current_user']) && $_SESSION['current_user']->role == '3') {

            if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['delete'])) {
                $this->historyEventService->deleteCardContent($_POST['id']);
                $deleteCardMessage = "Card Content deleted!";
            } elseif (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['deleteSchedule'])) {
                $this->historyEventService->deleteScheduleContent($_POST['tableId']);
                $deleteScheduleMessage = "Schedule Content deleted!";
            }

            // update methods
            if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['update'])) {
                $this->historyEventService->updateCardContent($_POST['id'], $_POST['title'], $_POST['image'], $_POST['content']);
                $updateCardMessage = "Card Content updated!";
            } else if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['updateSchedule'])) {
                $this->historyEventService->updateScheduleContent($_POST['id'], $_POST['dateAndDay'], $_POST['time'], $_POST['language'], $_POST['ticketAmount'], $_POST['price']);
                $updateSchedule = "Schedule Content updated!";
            } else if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['updateMainContent'])) {
                $this->historyEventService->updateMainContent($_POST['id'], $_POST['mainImageHeader'], $_POST['tourCardHeader'], $_POST['tourCardParagraph'], $_POST['tourCardButtonText']);
                $updateMainContentMessage = "Main Content updated!";
            }

            // add methods
            if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['submit'])) {
                $this->historyEventService->addCardContent($_POST);
                $addCardMessage = "Card Content added!";
            } else if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['submitSchedule'])) {
                $this->historyEventService->addScheduleContent($_POST['dateAndDay'], $_POST['time'], $_POST['language'], $_POST['ticketAmount'], $_POST['price']);
                $addScheduleMessage = "Schedule Content added!";
            }

            //used to get data from db to the view
            $locations = $this->historyEventService->getAllHistoryCard();
            $historyTourTimetable = $this->historyEventService->getHistoryTourTimetable();
            $content = $this->historyEventService->getHistoryPageContent();

            include __DIR__ . '/../view/header_history.php';
            require __DIR__ . '/../view/history/historyAdmin/historyManagement.php';
        }
    }

}