<?php
require_once __DIR__ . '/../header.php';
require_once __DIR__ . '/../../service/qrCodeGenerator.php';

$link = "https://www.google.com";
$qrCodeGenerator = new qrCodeGenerator();
$dataUri = $qrCodeGenerator->generateQrCode($link);
//header('Content-Type: '.$result->getMimeType());
//echo $result->getString();
?>
<h1 class="mb-5 text-center">Hey Rares, here are your tickets!</h1>
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="<?=$dataUri?>" class="img-fluid rounded-start" alt="qrCode">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h1 class="card-title text-center">Afrojack @ jopenkerk</h1>
                    <ul class="fs-3 mt-5">
                        <li>Customer: Rares Simion</li>
                        <li>Date of event: 24/07/2023</li>
                        <li>Start time: 20:00</li>
                    </ul>
                <p class="card-text"><small class="text-body-secondary mt-4">© 2023 Team Haarlem Design</small></p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="<?=$dataUri?>" class="img-fluid rounded-start" alt="qrCode">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
        </div>
    </div>
</div>


<?php
//require_once __DIR__ . '/../footer.php';
?>

