<?php

require_once(realpath($_SERVER['DOCUMENT_ROOT']) . "/../repository/appointmentRepository.php");
require_once(realpath($_SERVER['DOCUMENT_ROOT']) . "/../model/appointment.php");

class appointmentControllerAPI
{


    private $appointmentRepository;

    // initialize services
    function __construct()
    {
        $this->appointmentRepository = new appointmentRepository();
    }

    public function add(){
        $body = file_get_contents('php://input');
        $obj = json_decode($body);
        $appointment = new appointment();
        //$appointment->setId($obj->id);
        $appointment->setClientName($obj->name);
        $appointment->setLawyerId($obj->lawyer);
        $appointment->setLawArea($obj->area);
        $appointment->setDate($obj->date);
        $appointment->setTimeFrom($obj->time_from);
        $appointment->setTimeTo($obj->time_to);
        $insert = $this->appointmentRepository->addAppointment($appointment);

        if ($insert) {
            $_SESSION['last_event_id'] = $this->appointmentRepository->lastID();
            $_SESSION['lawyer_id'] = $appointment->lawyer_id;
        }

    }

    public function delete(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // your code here
        $body = file_get_contents('php://input');
        $obj = json_decode($body);
        $appointment = new appointment();
        $appointment->setId($obj->id);

        $this->appointmentRepository->deleteAppointment($appointment->getId());
        }
    }

    // router maps this to /api/article automatically
    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');

        // Respond to a GET request to /api/article
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            // your code here
            $appointments = $this->appointmentRepository->getAllAppointments();
            header('Content-Type: application/json');
            echo json_encode($appointments);

            // return all articles in the database as JSON

        }

    }
}