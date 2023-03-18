<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
<div id="qr-reader" style="width: 600px"></div>
<div id="qr_link">

</div>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        var link_div = document.getElementById("qr_link");
        var link = document.createElement("a");
        link.href = decodedText;
        link.innerHTML = "Click here";
        link_div.innerHTML = "Link: " + link;
    }
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);


</script>
</body>
</html>