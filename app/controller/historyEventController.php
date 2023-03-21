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
    public function historyManagement($addError) {

        if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['delete'])){
            $this->deleteContent($_POST['id']);
        }
        if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['update'])){
            $this->updateContent($_POST['id'], $_POST['title'], $_POST['image'], $_POST['content']);
        }
        $locations = $this->historyEventService->getAllHistoryCard();
        require __DIR__ . '/../view/history/historyAdmin/historyManagement.php';
    }

    public function deleteContent($id)
    {
        $this->historyEventService->deleteContent($id);
    }

    public function updateContent($id, $title, $image, $content) {
        $this->historyEventService->updateContent($id, $title, $image, $content);
    }

    public function displayAddedContent() : void {
        try {
            if (($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['submit'])) {
                $this->addContent($_POST);
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
    public function addContent($data) :void {
        try {
            $this->historyEventService->addContent($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}