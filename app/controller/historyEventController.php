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

        include __DIR__ . '/../view/header_history.php';
        require __DIR__ . "/../view/history/history.php";
        include __DIR__ . '/../view/footer.php';
    }

    public function historyCartPage($id){
        $ticketById = $this->historyEventService->getHistoryTicketById($id);
        include __DIR__ . '/../view/header_history.php';
        require __DIR__ . '/../view/history/historyCart.php';
        include __DIR__ . '/../view/footer.php';

    }
    public function historyLocationDetailPage($id) {
        $locationDetailById = $this->historyEventService->getLocationDetailById($id);
        include __DIR__ . '/../view/header_history.php';
        require __DIR__ . '/../view/history/historyLocationDetail.php';
        include __DIR__ . '/../view/footer.php';
    }
    public function historyManagement($addError) {

        if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['delete'])){
            $this->deleteCardContent($_POST['id']);
        } elseif (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['deleteSchedule'])){
            $this->deleteScheduleContent($_POST['tableId']);
        }

        if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['update'])){
            $this->updateCardContent($_POST['id'], $_POST['title'], $_POST['image'], $_POST['content']);
        } else if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['updateSchedule'])) {
            $this->updateScheduleContent($_POST['tableId'], $_POST['dateAndDay'], $_POST['time'], $_POST['language'], $_POST['ticketAmount']);
        }
        $locations = $this->historyEventService->getAllHistoryCard();
        $historyTourTimetable = $this->historyEventService->getHistoryTourTimetable();
        include __DIR__ . '/../view/header_history.php';
        require __DIR__ . '/../view/history/historyAdmin/historyManagement.php';

    }

    public function deleteScheduleContent($id)
    {
        $this->historyEventService->deleteScheduleContent($id);
    }
    public function updateScheduleContent($id, $dateAndDay, $time, $language, $ticketAmount) {
        $this->historyEventService->updateScheduleContent($id, $dateAndDay, $time, $language, $ticketAmount);
    }


    public function deleteCardContent($id)
    {
        $this->historyEventService->deleteCardContent($id);
    }
    public function updateCardContent($id, $title, $image, $content) {
        $this->historyEventService->updateCardContent($id, $title, $image, $content);
    }
    public function displayAddedContent() : void {
        try {
            if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['submit'])) {
                $this->addCardContent($_POST);
                $addError = "Content added";
            } else if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['submitSchedule'])) {
                $this->addScheduleContent($_POST);
                $addError = "Content added";
            } else {
                $addError = "Could not add content";
            }
            $this->historyManagement($addError);
        } catch (Exception $e) {
            echo $e;
            throw new Exception($e->getMessage());
        }
    }
    /**
     * @throws Exception
     */
    public function addCardContent($data) :void {
        try {
            $this->historyEventService->addCardContent($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function addScheduleContent($data) :void {
        try {
            $this->historyEventService->addScheduleContent($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}