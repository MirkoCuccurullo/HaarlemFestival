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

    public function updateReservation($reservation): void
    {
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