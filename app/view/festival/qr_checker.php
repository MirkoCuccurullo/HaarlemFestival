<?php
include __DIR__ . '/../header_dance.php';
?>
<!--<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>-->
<script src="https://unpkg.com/html5-qrcode@2.3.7/html5-qrcode.min.js"></script>
<div style="flex-wrap: wrap; justify-content: center;">
    <div id="qr-reader" class="m-3" style="width: 600px"></div>
    <div id="qr_link" class="m-3">

    </div>
</div>
<h1 id="message" style="color: #FFFFFF"></h1>



<?php
include __DIR__ . '/../footer.php'; ?>
<script>
    changeFooterToDanceStyle();

    function changeFooterToDanceStyle() {
        document.getElementById("undernavbar").remove();
        document.getElementById("footer").style.backgroundColor = "#d9d9d9";
    }

    function onScanSuccess(decodedText, decodedResult) {
        //console.log(decodedText);
        //createButtonLink(decodedText);
        console.log(`Code matched = ${decodedText}`, decodedResult);

        setTimeout(() => {
            html5QrcodeScanner.pause();

            setTimeout(() => {
                html5QrcodeScanner.resume();
            }, 3000);
        }, 1);

        fetch(decodedText)
            .then(response => {
                // Check the API response status
                if (response.ok) {
                    // Display a success message
                    showMessage("Ticket scanned successfully!");

                } else {
                    // Display an error message
                    showMessage("Ticket is already scanned!");

                }
            })
            .catch(error => {
                // Display an error message if the API request fails
                showMessage("An error occurred while scanning the ticket.");
                console.error(error);
            });
    }

    function showMessage(message) {
        document.getElementById("message").innerHTML = message;
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 30, qrbox: 250 });

    html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    function createButtonLink(decodedText){
        window.location.replace(decodedText);
    }


</script>
