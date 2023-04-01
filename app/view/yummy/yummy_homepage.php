<?php include __DIR__ . '/../header.php'; ?>


<body style="background-color: #49111C; color:white;">
<!--<div class="col-md-2">-->
<!--    <button id="twitter-button" class="btn btn-primary">-->
<!--        <i class="fab fa-twitter col-md-2"></i>Twitter-->
<!--    </button>-->
<!--    <button id="facebook-button" class="btn btn-primary">-->
<!--        <i class="fab fa-facebook-f col-md-2"></i>Facebook-->
<!--    </button>-->
<!--</div>-->
<br>
<div id="restaurant-container">
    <?php foreach ($restaurants as $restaurant): ?>
        <div class="row" id="restaurantCard" style="   border: 1px solid white;
    border-radius: 10px;
    margin-bottom: 10px;
    padding: 10px;">
            <!-- Restaurant name and photo -->
            <div class="col-md-3" id="restaurantNameAndPhoto">
                <h3><?= $restaurant->name ?></h3>
                <?php $photos = explode(',', $restaurant->photo); ?>
                <img src="<?= $photos[0] ?>" alt="<?= $restaurant->name ?>">
            </div>

            <!-- Restaurant description -->
            <div class="col-md-3" id="restaurantDescription">
                <p><?= $restaurant->description ?></p>
            </div>

            <!-- Cuisines and dietary information -->
            <div class="col-md-3" id="RestaurantInfo">
                <div id="restaurant-cuisines">
                    <h4>Cuisines:</h4>
                    <p><?= $restaurant->cuisines ?></p>
                </div>
                <div id="restaurant-dietary-info">
                    <h4>Dietary Information:</h4>
                    <p><?= $restaurant->dietary?></p>
                </div>
            </div>

            <!-- Session times -->
            <div class="col-md-3" id="restaurant-sessions">
                <h4>Session Times:</h4>
                <ul>
                    <?php
                        $firstSessionDate = $restaurant->sessions[0]->date;
                    foreach ($restaurant->sessions as $session):
                    if ($firstSessionDate == $session->date) {
                        $start_time = new DateTime($session->startTime);
                        $end_time = new DateTime($session->endTime);
                        ?>
                        <li><?= $start_time->format('H:i') ?> - <?= $end_time->format('H:i') ?></li>
                    <?php } //this is the end of the if statement showing only the sessions with the same date as the first one
                    //this is because it's only relevant the times not the dates and showing them all is a repetition
                    else { continue; }
                    endforeach; ?>
                </ul>
                <br>
                <form method="post" action="/restaurant">
                    <input type="hidden" name="id" value="<?= $restaurant->id ?>">
                    <button type="submit" style="background: #ABAC7F; border-style: hidden; border-radius: 5%; width: 150px;" class="btn btn-primary">View More</button>
                </form>
            </div>
        </div>

        <br>
    <?php endforeach; ?>
</div>



</body>

    <?php include __DIR__ . '/../footer.php'; ?>
