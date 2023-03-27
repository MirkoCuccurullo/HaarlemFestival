<?php
// Include autoloader
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../model/ticket.php';
require_once __DIR__ . '/../model/dance.php';
require_once __DIR__ . '/../model/accessPass.php';
require_once __DIR__ . '/../model/user.php';

require_once __DIR__ . '/../service/eventService.php';
require_once __DIR__ . '/../service/accessPassService.php';
require_once __DIR__ . '/../service/userService.php';
require_once __DIR__ . '/../service/qrCodeGenerator.php';




// Reference the Dompdf namespace
use Dompdf\Dompdf;
class PDFGenerator
{
    public function createPDF($order)
    {
        $dompdf = new Dompdf();

        $html = '
        <!doctype html>
        <html lang="en">
        <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
          <title>Tickets</title>
</head>
<body>
        ';

        $userService = new userService();
        $user = $userService->getUserById($order->user_id);

        $html .= "<h1 class='mb-5 text-center'>" . "Hey " . $user->name . ", here are your tickets!" . "</h1>";

        $ticketService = new ticketService();
        $tickets = $ticketService->getTicketsByOrderId($order->id);

        foreach ($tickets as $ticket){

            $qrCodeGenerator = new qrCodeGenerator();
            $dataUri = $qrCodeGenerator->generateQrCode($ticket);

            $event = null;

            if(isset($ticket->dance_event_id))
            {
                $eventService = new eventService();

                $event = $eventService->getEventByID($ticket->dance_event_id);

                $artist = $eventService->getArtistById($event->artist);
                $event->artist_name = $artist->name;

                $venue_name = $eventService->getVenueById($event->location)->name;
                $event->venue_name = $venue_name;

            }
            else if(isset($ticket->access_pass_id))
            {
                $passService = new accessPassService();
                $event = $passService->getAccessPassById($ticket->access_pass_id);
            }

            $html .= '
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">';

            $html .= "<img src='$dataUri' alt='qrCode'>";

            $html .= '
</div>
        <div class="col-md-8">
            <div class="card-body">';


            if($event instanceof dance)
                $html .= "<h1 class='card-title text-center'>" . $event->artist_name . " @ " . $event->venue_name . "</h1>";
            else if($event instanceof accessPass) {
                $eventId = $event->id;
                $pass = $event->displayPass($eventId);
                $html .= "<h1 class='card-title text-center'>" . $pass . "</h1>";
            }

            $html .= '<ul class="fs-3 mt-5">';
            $html .= "<li>Customer: " . $user->name . "</li>";

            if (isset($event->date))
                $html .= "<li>Date of event: " . $event->date . "</li>";
            else
                $html .= "<li>Date of event: " . "N/A" . "</li>";

            if($event instanceof dance)
                $html .= "<li>Start time: " . $event->start_time . "</li>";
            else if($event instanceof accessPass)
                $html .= "<li>Start time: " . "N/A" . "</li>";

            $html .= '</ul>';

            $html .= '<p class="card-text"><small class="text-body-secondary mt-4">© 2023 Team Haarlem Design</small></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>';
        }

// Load HTML content
        $dompdf->loadHtml($html);


// (Optional) Set up the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
        $dompdf->render();
        $pdf_content = $dompdf->output();
        $file_name = "tickets_" . $order->id . ".pdf";
        file_put_contents($file_name, $pdf_content);

        return $file_name;
    }
}