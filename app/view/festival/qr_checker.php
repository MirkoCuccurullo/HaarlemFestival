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
<div id="enhancerUIContainer" style="height: 100vh;"></div>
<script src="https://unpkg.com/dynamsoft-camera-enhancer@2.1.0/dist/dce.js"></script>
<script>
    let enhancer = null;
    (async () => {
        enhancer = await Dynamsoft.DCE.CameraEnhancer.createInstance();
        document.getElementById("enhancerUIContainer").appendChild(enhancer.getUIElement());
        await enhancer.open(true);
    })();
</script>
<button id="capture">Capture</button>
<script>
    document.getElementById('capture').onclick = () => {
        if (enhancer) {
            let frame = enhancer.getFrame();

            let width = screen.availWidth;
            let height = screen.availHeight;
            let popW = 640, popH = 640;
            let left = (width - popW) / 2;
            let top = (height - popH) / 2;

            popWindow = window.open('', 'popup', 'width=' + popW + ',height=' + popH +
                ',top=' + top + ',left=' + left + ', scrollbars=yes');

            popWindow.document.body.appendChild(frame.canvas);
        }
    };
</script>
</body>
</html>