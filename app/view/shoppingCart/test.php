<?php
session_start();

//if (isset($_GET['action']) && isset($_POST['event'])) {
//    $action = $_GET['action'];
//    $unserializedEvent = json_decode($_POST['event']);
//    $event = unserialize($unserializedEvent);
//    if ($action == 'add') {
//        $_SESSION['order']->addEvent($event);
//    } else if ($action == 'remove') {
//        $_SESSION['order']->removeEvent($event);
//    }
//    //echo json_encode($_SESSION['order']);
//
//}



//if(isset($_POST['event'])) {
//    $unserializedEvent = json_decode($_POST['event']);
//    $event = unserialize($unserializedEvent);
//    $_SESSION['order']->addEvent($event);
//    echo json_encode($_SESSION['order']);
//}

$data = json_decode(file_get_contents('php://input'), true);
$event = unserialize($data['event']);
$_SESSION['order']->addEvent($event);
echo json_encode($_SESSION['order']);

//echo json_encode($_SESSION['order']);

