<?php
require_once __DIR__ . '/../service/reservationService.php';

class reservationController
{
    private reservationService $reservationService;

    public function __construct()
    {
        $this->reservationService = new reservationService();
    }

    public function editReservation(): void
    {
        $reservation = $this->reservationService->getReservationByID($_POST['id']);
        require __DIR__ . '/../view/management/editReservation.php';
    }

    public function updateReservation(): void
    {
        $this->reservationService->updateReservation($_POST['id'], $_POST['restaurantName'],  $_POST['session'], $_POST['status'], $_POST['numberOfAdults'], $_POST['numberOfUnder12'], $_POST['reservationPrice'], $_POST['customerEmail'], $_POST['comment']);
        header('Location: /manage/reservation');
    }

    public function manageReservation(): void
    {
        $reservationInfo = $this->reservationService->getAllReservations();
        require __DIR__ . '/../view/management/manageReservation.php';
    }

    public function deactivateReservation(): void
    {
        $this->reservationService->deactivateReservation($_POST['id']);
        header('Location: /manage/reservation');
    }

    public function addReservation(): void
    {
        $reservation = new reservation();
        $reservation->restaurantName = $_POST['restaurantName'];
        $reservation->customerName = $_POST['name'];
        $reservation->session = $_POST['session'];
        $reservation->numberOfAdults = $_POST['numberOfAdults'];
        $reservation->numberOfUnder12 = $_POST['numberOfUnder12'];
        $reservation->customerEmail = $_POST['email'];
        $reservation->comment = $_POST['comment'];
        $this->reservationService->addReservation($reservation);
    }

    public function getAvailableSpacesPerSession(): int
    {
        return $this->reservationService->getAvailableSpacesPerSession($_POST['sessionId']);
    }

}