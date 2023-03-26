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
        $preparedData = $this->prepareCardContentData($data);
        $this->historyEventRepository->insertHistoryCardContent($preparedData['title'], $preparedData['image'], $preparedData['content']);
    }
    public function addScheduleContent(array $data)
    {
        $preparedData = $this->prepareScheduleContentData($data);
        $this->historyEventRepository->insertHistorySchedule($preparedData['dateAndDay'], $preparedData['time'], $preparedData['language'], $preparedData['ticketAmount']);
    }


    public function deleteCardContent($id) {
        $this->historyEventRepository->deleteHistoryCardContent($id);
    }
    public function deleteScheduleContent($id) {
        $this->historyEventRepository->deleteHistorySchedule($id);
    }

    public function updateCardContent($id, $title, $image, $content) {
        return $this->historyEventRepository->updateHistoryCardContent($id, $title, $image, $content);
    }
    public function updateScheduleContent($id, $dateAndDay, $time, $language, $ticketAmount) {
        return $this->historyEventRepository->updateHistorySchedule($id, $dateAndDay, $time, $language, $ticketAmount);
    }
    public function updateMainContent($mainImageHeader, $tourCardHeader , $tourCardParagraph , $tourCardButtonText ) {
        return $this->historyEventRepository->updateMainContent($mainImageHeader, $tourCardHeader , $tourCardParagraph , $tourCardButtonText );
    }


    private function prepareCardContentData(array $data): array
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
    private function prepareScheduleContentData(array $data): array
    {
        $dateAndDay = isset($data['$dateAndDay']) && !empty($data['$dateAndDay']) ? htmlspecialchars($data['$dateAndDay']) : null;
        $time = isset($data['$time']) && !empty($data['$time']) ? htmlspecialchars($data['$time']) : null;
        $language = isset($data['$language']) && !empty($data['$language']) ? htmlspecialchars($data['$language']) : null;
        $ticketAmount = isset($data['$ticketAmount']) && !empty($data['$ticketAmount']) ? htmlspecialchars($data['$ticketAmount']) : null;

        if (empty($dateAndDay) || empty($time) || empty($language) || empty($ticketAmount)) {
            $addError = ('All fields must be filled');
        }

        return [
            'dateAndDay' => $dateAndDay,
            'time' => $time,
            'language' => $language,
            'ticketAmount' => $ticketAmount,
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