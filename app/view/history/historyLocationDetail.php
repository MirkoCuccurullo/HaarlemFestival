<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/historyLocationDetail.css">
    <title>History Event</title>
</head>

<body>
<br>

<div class="container">
    <img id="locationImg" src="<?= $locationDetailById->image;?>" alt="Location Image">
    <h3><?= $locationDetailById->title?></h3>
    <p><?= $locationDetailById->additionalContent?></p>
</div>

</body>

</html>

