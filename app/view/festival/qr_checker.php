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

</body>
<script>
    if ('mediaDevices' in navigator && 'getUserMedia' in navigator.mediaDevices) {
        console.log("Let's get this party started")
    }

    navigator.mediaDevices.getUserMedia({video: true});
    
</script>
</html>
