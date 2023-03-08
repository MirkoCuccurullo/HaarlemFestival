<?php
include __DIR__ . '/../header.php'; ?>

    <head>
        <link href="../../public/css/style_food.css" rel="stylesheet">
        <title>Index</title>
    </head>

    <--add event name and description from event table in db-->
    <!--<div id="event-description">-->
    <!--    <h1>--><?php //= $event['name'] ?><!--</h1>-->
    <!--    <p>--><?php //= $event['description'] ?><!--</p>-->
    <!--</div>-->


    <--! Display the restaurants -->
    <div id="restaurant-cards" class="container">
<?php
foreach ($restaurants as $restaurant): ?>
    <div class="card">
        <div class="column">
            <h3 class="text"><?= $restaurant['name'] ?></h3>
            <img src="<?= $restaurant['image'] ?>" alt="Restaurant image"> </div>
        <div class="column"><?= $restaurant['description'] ?></div>
        <div class="column"><?= $restaurant['cuisines'] ?><br> <?= $restaurant['dietary'] ?> </div>
        <div class="column"> <ul>
                <!-- Loop through the sessions for the restaurant and display their information -->
                <?php foreach ($restaurant['sessions'] as $session): ?>
                    <li>
                        From <?= $session['startTime'] ?> to <?= $session['endTime'] ?><br>
                        Date: <?= $session['date'] ?><br>
                        Capacity: <?= $session['capacity'] ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a href="#" class="btn-primary"> learn more about <?= $restaurant['name'] ?></a>
            <a href="<?= $restaurant['name'] ?>" class="btn-primary"><?= $restaurant['name'] ?></a> </div>
    </>
    </div>
<?php endforeach; ?>
    </div>



<?php
include __DIR__ . '/../footer.php'; ?>