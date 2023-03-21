<?php
require_once __DIR__ . '/../repository/reservationRepository.php';
require_once __DIR__ . '/../model/reservation.php';

class reservationService
{
    private reservationRepository $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new reservationRepository();
    }

    public function getAllReservations(): array
    {
        return $this->reservationRepository->getAllReservations();
    }

    public function updateReservation($id, $restaurantName, $session, $status, $numberOfAdults, $numberOfUnder12, $reservationPrice, $customerEmail, $comment): void
    {
        $reservation = new reservation();
        $reservation->id = $id;
        $reservation->restaurantName = $restaurantName;
        $reservation->session = $session;
        $reservation->status = $status;
        $reservation->numberOfAdults = $numberOfAdults;
        $reservation->numberOfUnder12 = $numberOfUnder12;
        $reservation->reservationPrice = $reservationPrice;
        $reservation->customerEmail = $customerEmail;
        $reservation->comment = $comment;
        $this->reservationRepository->updateReservation($reservation);
    }

    public function addReservation($reservation): void
    {
        $this->reservationRepository->addReservation($reservation);
    }

    public function getReservationById(int $id): reservation
    {
        return $this->reservationRepository->getReservationById($id);
    }

    public function deactivateReservation(int $id): void
    {
        $this->reservationRepository->deactivateReservation($id);
    }
}