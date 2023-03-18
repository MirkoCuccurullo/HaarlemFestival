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
        $this->reservationService->updateReservation($_POST['id'], $_POST['startTime'], $_POST['endTime'], $_POST['date'], $_POST['capacity'], $_POST['reservationPrice'], $_POST['sessionPrice'],$_POST['restaurantId']);
        header('Location: /manage/reservation');
    }

    public function manageReservation(): void
    {
        $reservationInfo = $this->reservationService->getAllReservations();
        require __DIR__ . '/../view/management/manageReservation.php';
    }

    public function deactivateReservation()
    {
        $this->reservationService->deactivateReservation($_POST['id']);
        header('Location: /manage/reservation');
    }

}