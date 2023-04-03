<?php
require_once __DIR__ . '/../service/reservationService.php';
require_once __DIR__ . '/../model/reservation.php';

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
        $reservation = new reservation();
        $reservation->id = $_POST['id'];
        $reservation->restaurantName = $_POST['restaurantName'];
        $reservation->sessionId = $_POST['sessionId'];
        $reservation->status = $_POST['status'];
        $reservation->numberOfAdults = $_POST['numberOfAdults'];
        $reservation->numberOfUnder12 = $_POST['numberOfUnder12'];
        $reservation->reservationPrice = $_POST['reservationPrice'];
        $reservation->customerEmail = $_POST['customerEmail'];
        $reservation->comment = $_POST['comment'];
        $this->reservationService->updateReservation($reservation);
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
        $reservation->sessionId = $_POST['sessionId'];
        $reservation->numberOfAdults = $_POST['adults'];
        $reservation->numberOfUnder12 = $_POST['under12'];
        $reservation->customerEmail = $_POST['email'];
        $reservation->comment = $_POST['comment'];
        $reservation->status = 'pending';
        $reservation->reservationPrice = $reservation->numberOfAdults * 10 + $reservation->numberOfUnder12 * 10;
        $this->reservationService->addReservation($reservation);
        header('Location: /shoppingCart');
    }

    public function getAvailableSpacesPerSession(): int
    {
        return $this->reservationService->getAvailableSpacesPerSession(intval($_POST['sessionId']));
    }

    public function addReservationToShoppingCart()
    {

    }

}