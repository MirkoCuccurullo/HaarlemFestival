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
        // delete methods
        if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['delete'])) {
            $this->deleteCardContent($_POST['id']);
            $deleteCardMessage = "Card Content deleted!";
        } elseif (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['deleteSchedule'])) {
            $this->deleteScheduleContent($_POST['tableId']);
            $deleteScheduleMessage = "Schedule Content deleted!";
        }
        if (isset($_SESSION['current_user']) && $_SESSION['current_user']->role == '3') {

            if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['delete'])) {
                $this->deleteCardContent($_POST['id']);
            } elseif (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['deleteSchedule'])) {
                $this->deleteScheduleContent($_POST['tableId']);
            }

            // update methods
            if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['update'])) {
                $this->updateCardContent($_POST['id'], $_POST['title'], $_POST['image'], $_POST['content']);
                $updateCardMessage = "Card Content updated!";
            } else if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['updateSchedule'])) {
                $this->updateScheduleContent($_POST['id'], $_POST['dateAndDay'], $_POST['time'], $_POST['language'], $_POST['ticketAmount'], $_POST['price']);
                $updateSchedule = "Schedule Content updated!";
            } else if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['updateMainContent'])) {
                $this->updateMainContent($_POST['id'], $_POST['mainImageHeader'], $_POST['tourCardHeader'], $_POST['tourCardParagraph'], $_POST['tourCardButtonText']);
                $updateMainContentMessage = "Main Content updated!";
            }

            // add methods
            if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['submit'])) {
                $this->addCardContent($_POST);
                $addCardMessage = "Card Content added!";
            } else if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['submitSchedule'])) {
                $this->addScheduleContent($_POST['dateAndDay'], $_POST['time'], $_POST['language'], $_POST['ticketAmount'], $_POST['price']);
                $addScheduleMessage = "Schedule Content added!";
            }
            if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['update'])) {
                $this->updateCardContent($_POST['id'], $_POST['title'], $_POST['image'], $_POST['content']);
            } else if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['updateSchedule'])) {
                $this->updateScheduleContent($_POST['id'], $_POST['dateAndDay'], $_POST['time'], $_POST['language'], $_POST['ticketAmount'], $_POST['price']);
            } else if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['updateMainContent'])) {
                $this->updateMainContent($_POST['id'], $_POST['mainImageHeader'], $_POST['tourCardHeader'], $_POST['tourCardParagraph'], $_POST['tourCardButtonText']);
            }

            //used to get data from db to the view
            $locations = $this->historyEventService->getAllHistoryCard();
            $historyTourTimetable = $this->historyEventService->getHistoryTourTimetable();
            $content = $this->historyEventService->getHistoryPageContent();

            include __DIR__ . '/../view/header_history.php';
            require __DIR__ . '/../view/history/historyAdmin/historyManagement.php';
            }
        }

    /**
     * @throws Exception
     */
    public function addCardContent($data): void
    {
        $this->historyEventService->addCardContent($data);
    }

    public function addScheduleContent(string $dateAndDay, string $time, string $language, int $ticketAmount, float $price): void
    {
        $this->historyEventService->addScheduleContent($dateAndDay, $time, $language, $ticketAmount, $price);
    }

    // Delete methods
    public function deleteScheduleContent($id)
    {
        $this->historyEventService->deleteScheduleContent($id);
    }

    public function deleteCardContent($id)
    {
        $this->historyEventService->deleteCardContent($id);
    }

    // Update methods
    public function updateScheduleContent($id, $dateAndDay, $time, $language, $ticketAmount, $price)
    {
        $this->historyEventService->updateScheduleContent($id, $dateAndDay, $time, $language, $ticketAmount, $price);
    }

    public function updateCardContent($id, $title, $image, $content)
    {
        $this->historyEventService->updateCardContent($id, $title, $image, $content);
    }

    public function updateMainContent($id, $mainImageHeader, $tourCardHeader, $tourCardParagraph, $tourCardButtonText)
    {
        $this->historyEventService->updateMainContent($id, $mainImageHeader, $tourCardHeader, $tourCardParagraph, $tourCardButtonText);
    }
}