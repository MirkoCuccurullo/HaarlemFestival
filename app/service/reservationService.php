<?php
require_once __DIR__ . '/../repository/reservationRepository.php';
require_once __DIR__ . '/../model/reservation.php';
require_once __DIR__ . '/../model/session.php';

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

    public function addReservation($reservation)
    {
       return $this->reservationRepository->addReservation($reservation);
    }

    public function getReservationById(int $id): reservation
    {
        return $this->reservationRepository->getReservationById($id);
    }

    public function deactivateReservation(int $id): void
    {
        $this->reservationRepository->deactivateReservation($id);
    }
    public function getSessionByID($sessionId)
    {
        return $this->reservationRepository->getSessionById($sessionId);
    }

}