<?php

require_once '../repository/historyEventRepository.php';

class historyEventService{
    private $historyEventRepository;

    public function __construct(){
        $this->historyEventRepository = new historyEventRepository();
    }

    /*                  CRUD METHODS                 */
    public function addCardContent(array $data)
    {
        $preparedData = $this->prepareData($data);
        $this->historyEventRepository->insertHistoryCardContent($preparedData['title'], $preparedData['image'], $preparedData['content']);
    }
    public function deleteCardContent($id) {
        $this->historyEventRepository->deleteHistoryCardContent($id);
    }

    public function updateCardContent($id, $title, $image, $content) {
        return $this->historyEventRepository->updateHistoryCardContent($id, $title, $image, $content);
    }
    private function prepareData(array $data): array
    {
        $title = isset($data['title']) && !empty($data['title']) ? htmlspecialchars($data['title']) : null;
        $image = isset($data['image']) && !empty($data['image']) ? htmlspecialchars($data['image']) : null;
        $content = isset($data['content']) && !empty($data['content']) ? htmlspecialchars($data['content']) : null;

        if (empty($title) || empty($content)) {
            $addError = ('Title and content fields cannot be empty');
        }

        return [
            'title' => $title,
            'image' => $image,
            'content' => $content,
        ];
    }


    /*                  GET METHODS                 */
    public function getAllHistoryCard() {
        return $this->historyEventRepository->getAllHistoryCard();
    }

    public function getHistoryPageContent() {
        return $this->historyEventRepository->getHistoryPageContent();
    }

    public function getHistoryTourTimetable() {
        return $this->historyEventRepository->getHistoryTourTimetable();
    }

    public function getHistoryTicketById($id){
        return $this->historyEventRepository->getHistoryTicketById($id);
    }

    public function getLocationDetailById($id)
    {
        return $this->historyEventRepository->getLocationDetailById($id);
    }

}