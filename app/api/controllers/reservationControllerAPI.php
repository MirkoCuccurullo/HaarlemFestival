<?php
require_once __DIR__ . '/../../service/reservationService.php';
require_once __DIR__ . '/../../model/reservation.php';

class reservationControllerAPI
{
 private reservationService $reservationService;

    public function __construct()
    {
        $this->reservationService = new reservationService();
    }

    public function index(): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        // Respond to a GET request to /api/session
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $reservations = $this->reservationService->getAllReservations();
            header('Content-Type: application/json');
            echo json_encode($reservations);

        }
    }

    public function deactivate(): void
    {

    }
}
