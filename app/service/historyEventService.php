<?php

require_once '../repository/historyEventRepository.php';

class historyEventService{
    private $historyEventRepository;

    public function __construct(){
        $this->historyEventRepository = new historyEventRepository();
    }

    /*                  CRUD METHODS                 */
    // Add methods
    public function addCardContent(array $data)
    {
        $preparedData = $this->prepareCardContentData($data);
        $this->historyEventRepository->insertHistoryCardContent($preparedData['title'], $preparedData['image'], $preparedData['content']);
    }
    public function addScheduleContent(string $dateAndDay, string $time, string $language, int $ticketAmount)
    {
        $preparedData = $this->prepareScheduleContentData($dateAndDay, $time, $language, $ticketAmount);
        $this->historyEventRepository->insertHistorySchedule($preparedData['dateAndDay'], $preparedData['time'], $preparedData['language'], $preparedData['ticketAmount']);
    }


    // Delete methods
    public function deleteCardContent($id) {
        $this->historyEventRepository->deleteHistoryCardContent($id);
    }
    public function deleteScheduleContent($id) {
        $this->historyEventRepository->deleteHistorySchedule($id);
    }

    // Update methods
    public function updateCardContent($id, $title, $image, $content) {
        return $this->historyEventRepository->updateHistoryCardContent($id, $title, $image, $content);
    }
    public function updateScheduleContent($id, $dateAndDay, $time, $language, $ticketAmount) {
        return $this->historyEventRepository->updateHistorySchedule($id, $dateAndDay, $time, $language, $ticketAmount);
    }
    public function updateMainContent($id, $mainImageHeader, $tourCardHeader , $tourCardParagraph , $tourCardButtonText ) {
        return $this->historyEventRepository->updateMainContent($id, $mainImageHeader, $tourCardHeader , $tourCardParagraph , $tourCardButtonText );
    }

    // Get methods
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
    public function getByDayFilter($day)
    {
        return $this->historyEventRepository->getByDayFilter($day);
    }

    // Prepare methods
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
    private function prepareScheduleContentData(string $dateAndDay, string $time, string $language, int $ticketAmount): array
    {
        return [
            'dateAndDay' => htmlspecialchars($dateAndDay),
            'time' => htmlspecialchars($time),
            'language' => htmlspecialchars($language),
            'ticketAmount' => $ticketAmount,
        ];
    }

    public function getHistoryEventByID(string $id)
    {
        return $this->historyEventRepository->getHistoryEventByID($id);
    }


}