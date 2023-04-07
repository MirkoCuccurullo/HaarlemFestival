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
        try {
            // Check that all form data is present
            if (!isset($_POST['id']) || !isset($_POST['restaurantName']) || !isset($_POST['sessionId']) || !isset($_POST['status']) || !isset($_POST['numberOfAdults']) || !isset($_POST['numberOfUnder12']) || !isset($_POST['reservationPrice']) || !isset($_POST['customerEmail']) || !isset($_POST['comment']) || !isset($_POST['customerName'])) {
                throw new Exception('One or more required fields are missing');
            }

            // Sanitize form data
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $restaurantName = filter_var($_POST['restaurantName'], FILTER_SANITIZE_STRING);
            $sessionId = filter_var($_POST['sessionId'], FILTER_SANITIZE_NUMBER_INT);
            $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
            $numberOfAdults = filter_var($_POST['numberOfAdults'], FILTER_SANITIZE_NUMBER_INT);
            $numberOfUnder12 = filter_var($_POST['numberOfUnder12'], FILTER_SANITIZE_NUMBER_INT);
            $price = filter_var($_POST['reservationPrice'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $customerEmail = filter_var($_POST['customerEmail'], FILTER_SANITIZE_EMAIL);
            $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
            $customerName = filter_var($_POST['customerName'], FILTER_SANITIZE_STRING);

            // Instantiate reservation object and set properties
            $reservation = new Reservation();
            $reservation->id = $id;
            $reservation->restaurantName = $restaurantName;
            $reservation->sessionId = $sessionId;
            $reservation->status = $status;
            $reservation->numberOfAdults = $numberOfAdults;
            $reservation->numberOfUnder12 = $numberOfUnder12;
            $reservation->price = $price;
            $reservation->customerEmail = $customerEmail;
            $reservation->comment = $comment;
            $reservation->customerName = $customerName;

            // Call reservation service to update reservation
            $this->reservationService->updateReservation($reservation);
            // Redirect to manage reservations page
            header('Location: /manage/reservation');
        } catch (Exception $e) {
            // Log error message and redirect to error page
            error_log($e->getMessage());
            header('Location: /error');
        }
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

    public function addReservation()
    {
        try {
            // Sanitize form data
            $restaurantName = filter_var($_POST['restaurantName'], FILTER_SANITIZE_STRING);
            $sessionId = filter_var($_POST['sessionId'], FILTER_SANITIZE_NUMBER_INT);
            $numberOfAdults = filter_var($_POST['adults'], FILTER_SANITIZE_NUMBER_INT);
            if (isset($_POST['under12'])) {
                $numberOfUnder12 = filter_var($_POST['under12'], FILTER_SANITIZE_NUMBER_INT);
            } else {
                $numberOfUnder12 = 0;
            }
           $customerEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            if (isset($_POST['comment'])) {
                $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
            } else {
                $comment = "None";
            }
            $customerName = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

                // Instantiate reservation object and set properties
                $reservation = new Reservation();
                $reservation->restaurantName = $restaurantName;
                $reservation->sessionId = $sessionId;
                $reservation->numberOfAdults = $numberOfAdults;
                $reservation->numberOfUnder12 = $numberOfUnder12;
                $reservation->customerEmail = $customerEmail;
                $reservation->customerName = $customerName;
                $reservation->comment = $comment;
                $reservation->status = "Pending";

                //the price depends on the session so get the session to calculate
                $session = $this->reservationService->getSessionByID($reservation->sessionId);
                $reservation->price = ($reservation->numberOfAdults + $reservation->numberOfUnder12) * $session->reservationPrice;
               $reservation = $this->reservationService->addReservation($reservation);
        } catch (Exception $e) {
            // Log error message and redirect to error page
            error_log($e->getMessage());
        }
        return $reservation;
    }

    public function getAvailableSpacesPerSession(): int
    {
        return $this->reservationService->getAvailableSpacesPerSession(intval($_POST['sessionId']));
    }

}