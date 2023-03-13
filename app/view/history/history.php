<!Doctype html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/css/history.css">
        <title>History Event</title>
</head>

<body>
<div class="image-container">
    <img id="mainImg" alt="main image" src="1.jpg">
    <h1 class="img-txt"><?php if(isset($content[0]->mainImageHeader)) echo $content[0]->mainImageHeader?></h1>
    <div class="tour-card">
        <div class="card-body">
            <h5 class="card-title"><?php if(isset($content[0]->tourCardHeader)) echo $content[0]->tourCardHeader?></h5>
            <p class="card-text"> <?php if(isset($content[0]->tourCardParagraph)) echo $content[0]->tourCardParagraph?></p>
            <a href="#" class="btn"><?php if(isset($content[0]->tourCardButtonText)) echo $content[0]->tourCardButtonText?></a>
            <a href="#schedule" class="btn"><?php if(isset($content[1]->tourCardButtonText)) echo $content[1]->tourCardButtonText?></a>
        </div>
    </div>
</div>

<h3 class="heading">All Locations Visited During Tour</h3>
<div class="card-container">
    <?php if (isset($locations)) foreach($locations as $location) { ?>
        <div class="card">
            <img id="cardImg" src="1.jpg" alt="">
            <h3><?= $location->title?></h3>
            <p><?= $location->content?></p>
            <div class="cardButton">
                <button id="learnMoreButton">Learn More</button>
            </div>
        </div>
    <?php } ?>
</div>


<h3 class="schedule" id="schedule">SCHEDULE VIEW</h3> <br>
<h3 class="from-to">FROM 27 JULY TO 31 JULY</h3>
<?php
$prevDate = '';
if (isset($historyTourTimetable)) {
    foreach ($historyTourTimetable as $timetable) {
        $dateAndDay = $timetable['dateAndDay'];
        $time = $timetable['time'];
        $language = $timetable['language'];
        $ticketAmount = $timetable['ticketAmount'];

        if ($dateAndDay != $prevDate) {
            echo '<p class="event-date" id="eventDate">' . $dateAndDay . '</p> </br>';
            $prevDate = $dateAndDay;
        }
        ?>
        <table class="table1" id="table1" style="margin-top: 50px">
            <thead>
            <tr>
                <th scope="col">Time</th>
                <th scope="col"><?php if(isset($language)) echo $language?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row"><?php if(isset($time)) echo $time?></th>
                <td><a href="/historyCart?id=<?php echo $timetable['id'];?>"><button id="tickbut"><?php if(isset($ticketAmount)) echo $ticketAmount?> tickets available</button></a></td>
            </tr>
            </tbody>
        </table>
        <?php
    }
}
?>

</body>

</html>


<?php include __DIR__ . '/../footer.php'; ?>
