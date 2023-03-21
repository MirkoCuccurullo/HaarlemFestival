<?php
// Include autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Reference the Dompdf namespace
use Dompdf\Dompdf;
class PDFGenerator
{
    public function createPDF()
    {
        $dompdf = new Dompdf();

        $html = '
<style>
    table {
        font-family: arial,serif;
        width:400px;
        border-collapse: collapse;
    }
    td, th {
        border: 1px solid black;
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even) {
        background-color: grey;
    }
</style>
<h1>Haarlem Festival</h1>
<h3>List of Ticket Purchased </h3>
';
// Load HTML content
        $dompdf->loadHtml($html);


// (Optional) Set up the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
        $dompdf->render();
        return $dompdf;
    }
}