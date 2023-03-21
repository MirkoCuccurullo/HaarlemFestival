<?php include __DIR__ . '/../historyHeader.php'; ?>

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
    <?php if(isset($locationDetailById)) { ?>
    <img id="locationImg" src="<?php echo $locationDetailById->image;?>" alt="Location Image">
    <h3><?= $locationDetailById->title?></h3>
    <p><?= $locationDetailById->additionalContent?></p>
<?php } ?>
</div>

</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>
