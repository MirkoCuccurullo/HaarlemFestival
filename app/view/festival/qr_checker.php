<?php
include __DIR__ . '/../header.php';
?>
<!--<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>-->
<script src="https://unpkg.com/html5-qrcode@2.3.7/html5-qrcode.min.js"></script>
<div class="container text-center">
    <h1>QR scanner</h1>
    <div class="container text-center" style="padding-left: 20em; padding-bottom: 1em">
        <div id="qr-reader" class="m-3 text-center" style="width: 600px"></div>
        <div id="qr_link" class="m-3">
        </div>

    </div>
    <div id="alert-box" role="alert" hidden>
        <h1 id="message" style="color: #000000"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>


<?php
include __DIR__ . '/../footer.php'; ?>
<script>
    removeBannerImage();

    function removeBannerImage() {
        document.getElementById("banner-container").remove();
    }

    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Code matched = ${decodedText}`, decodedResult);

        setTimeout(() => {
            html5QrcodeScanner.pause();

            setTimeout(() => {
                html5QrcodeScanner.resume();
            }, 3000);
        }, 1);

        fetch(decodedText)
            .then(response => {
                if (response.ok) {
                    showSuccessMessage("Ticket scanned successfully!");

                } else {
                    showFailureMessage("Ticket is already scanned!");

                }
            })
            .catch(error => {
                showFailureMessage("An error occurred while scanning the ticket.");
                console.error(error);
            });
    }

    function showFailureMessage(message) {
        document.getElementById("message").innerHTML = message;
        let alertBox = document.getElementById("alert-box");
        alertBox.className = "alert alert-danger alert-dismissible fade show";
        alertBox.hidden = false;
    }

    function showSuccessMessage(message) {
        document.getElementById("message").innerHTML = message;
        let alertBox = document.getElementById("alert-box");
        alertBox.className = "alert alert-success alert-dismissible fade show";
        alertBox.hidden = false;
    }

    function onScanFailure(error) {
        console.warn(`Code scan error = ${error}`);
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", {fps: 30, qrbox: 250});

    html5QrcodeScanner.render(onScanSuccess, onScanFailure);


</script>
