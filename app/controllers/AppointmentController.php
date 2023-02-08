<?php

class AppointmentController
{
    public function showForm()
    {
        require("../view/home/appointment.php");
    }

    public function addAppointment($appointment){
        require_once("../repository/appointmentRepository.php");
        $repo = new appointmentRepository();
        $repo->addAppointment($appointment);
    }

    public function showManagementForm(){
        require("../view/home/management.php");
    }


    public function showEventForm()
    {
        require_once("../view/home/add_appointment.php");
    }

    public function editAppointment($newAppointment, $id){
        require_once("../repository/appointmentRepository.php");
        $repo = new appointmentRepository();
        $repo->updateAppointment($newAppointment, $id);
        $this->showManagementForm();
    
    }
}