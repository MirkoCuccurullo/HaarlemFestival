<?php

use public\GoogleApi\GoogleCalendar;

include_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/../config.php");

include_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/../GoogleApi/GoogleCalendar.php");

$statusMSG = '';
$status = 'danger';

if (isset($_GET['code'])) {

    session_start();
    $GoogleCalendar = new GoogleCalendar();

    $event_id = $_SESSION['last_event_id'];


    if (!empty($event_id)) {
        include_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/../repository/appointmentRepository.php");
        include_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/../model/appointment.php");

        $connection = new PDO("mysql:host=$db_host; dbname=$db_name", $db_username, $db_password);

        $sqlQ = "SELECT * FROM event WHERE id = :id";
        $stmt = $connection->prepare($sqlQ);
        $stmt->bindParam(":id", $event_id);
        $result = $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'appointment');
        $event_data = $stmt->fetch();

        if (!empty($event_data)) {
            $calendar_event = array(
                'client_name' => $event_data->client_name,
                'lawyer' => $event_data->lawyer_id,
                'description' => "law firm appointment"
            );

            $event_datetime = array(
                'event_date' => $event_data->date,
                'start_time' => $event_data->time_from,
                'end_time' => $event_data->time_to
            );

            $data = $GoogleCalendar->GetAccessToken(GOOGLE_CLIENT_ID, REDIRECT_URI, GOOGLE_CLIENT_SECRET, $_GET['code']);
            $access_token = $data['access_token'];
            $_SESSION['google_access_token'] = $access_token;

            if (!empty($_SESSION['google_access_token'])) {

               $access_token = $_SESSION['google_access_token'];

            }
        }

        if (!empty($access_token)) {

                //retrieve timezone and book event
                $user_timezone = $GoogleCalendar->GetUserCalendarTimezone($access_token);
                $google_event_id = $GoogleCalendar->CreateCalendarEvent($access_token, 'primary', $calendar_event, 0, $event_datetime, $user_timezone);
                if ($google_event_id) {

                    //store event code in the database
                    $sqlQ = "UPDATE event SET google_calendar_event_id=:event_id WHERE id=:id";
                    $stmt = $connection->prepare($sqlQ);
                    $stmt->bindParam(':event_id', $google_event_id);
                    $stmt->bindParam(':id', $event_id);

                    //$update = $app_repo->updateEventId($google_event_id, $event_id);
                    $update = $stmt->execute();

                    //add token to the user table

                     include_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/../model/lawyer.php");
                     $connection = new PDO("mysql:host=$db_host; dbname=$db_name", $db_username, $db_password);
                     $stmt = $connection->prepare("UPDATE employee SET google_token=:token WHERE employee_id=:id");
                     $stmt->bindParam(':token', $access_token);

                     $lawyer_id = $_SESSION['lawyer_id'];
                     $stmt->bindParam(':id', $lawyer_id);
                     $inserted = $stmt->execute();

                    unset($_SESSION['last_event_id']);
                    unset($_SESSION['google_access_token']);



                    $status = 'success';
                    $statusMSG = "<p>Event #'$event_id' has been added</p>";

                }

        }else {
            $statusMSG = "failed to fetch access token";
        }
    } else {
        $statusMSG = "event data not found";
    }
} else {
    $statusMSG = "event reference not found";
}

$_SESSION['status_response'] = array('status' => $status, 'status_msg' => $statusMSG);
header("Location: /addAppointment");
exit();






