<?php
include __DIR__ . '/../header_dance.php';
?>
<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
<div style="flex-wrap: wrap; justify-content: center;">
    <div id="qr-reader" class="m-3" style="width: 600px"></div>
    <div id="qr_link" class="m-3">

    </div>
</div>



<?php
include __DIR__ . '/../footer.php'; ?>
<script>
    changeFooterToDanceStyle();

    function changeFooterToDanceStyle() {
        document.getElementById("undernavbar").remove();
        document.getElementById("footer").style.backgroundColor = "#d9d9d9";
    }

    function onScanSuccess(decodedText, decodedResult) {
        console.log(decodedText);
        createButtonLink(decodedText);
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 30, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);

    function createButtonLink(decodedText){
        window.location.replace(decodedText);
    }

</script>
