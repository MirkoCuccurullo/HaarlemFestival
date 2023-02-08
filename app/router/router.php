<?php

class Router
{
    public function route($url)
    {

        switch ($url) {
            case'/api/appointmentDelete':
                require("../api/controllers/appointmentController.php");
                $controller = new appointmentControllerAPI();
                $controller->delete();
                break;
            case '/api/appointmentAdd':
                require("../api/controllers/appointmentController.php");
                $controller = new appointmentControllerAPI();
                $controller->add();
                break;
            case '/api/appointment':
                require("../api/controllers/appointmentController.php");
                $controller = new appointmentControllerAPI();
                $controller->index();
                break;
            case "/editAppointment":
                require("../repository/appointmentRepository.php");
                $controller = new appointmentRepository();
                $_SESSION['appointment'] = $controller->getAppointmentById($_POST['appointmentID']);
                require("../view/home/editAppointment.php");
                break;
            case "/login":
                require("../controllers/LoginController.php");
                $controller = new LoginController();
                $controller->login();
                break;
            case "/logout":
                require("../controllers/LoginController.php");
                $controller = new LoginController();
                $controller->logout();
                break;
            case "/register":
                require("../controllers/RegistrationController.php");
                $controller = new RegistrationController();
                $controller->showForm();
                break;
            case "/appointment":
                require("../controllers/AppointmentController.php");
                $controller = new AppointmentController();
                $controller->showForm();
                break;
            case "/add/lawyer":
                require("../controllers/RegistrationController.php");
                $controller = new RegistrationController();
                $controller->showFormLawyer();
                break;
            case "/management":
                require("../controllers/AppointmentController.php");
                $controller = new AppointmentController();
                $controller->showManagementForm();
                break;
            case "/addAppointment":
                require("../controllers/AppointmentController.php");
                $controller = new AppointmentController();
                $controller->showEventForm();
                break;
            case "/home/index":
            case"/":
                require("../controllers/HomeController.php");
                $controller = new HomeController();
                $controller->index();
                break;
            default:
                echo "404";
        }
    }
}