<?php include __DIR__ . '/../header.php'; ?>

<head>
    <link href="../../public/css/style_food.css" rel="stylesheet">
    <title> <?= $restaurant->name ?></title>
</head>
<body>
<a href="/yummy">
    <button style="border: 1px solid white; color: white;">
        Back to Restaurants
    </button>
</a>


<?php $photos = explode(',', $restaurant->photo); ?>
<div class="row">
<h3><?= $restaurant->name ?></h3>
    //TODO add the scroll to a specific element
    <button  style=" alignment: right; color: black; background: #ABAC7F; border-style: hidden; border-radius: 5%;" >
        <p class="text-center">Reserve</p>
    </button>
</div>

<div id="restaurant-container">
    <div class="row" id="restaurantDescription">
        <div class="col-md-6" id="restaurantDescription">
            <p><?= $restaurant->description ?></p>
        </div>
        <div class="col-md-3" id="restaurantMainPhoto">
            <img src="<?= $photos[0] ?>" alt="<?= $restaurant->name ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <img src="<?= $photos[1] ?>" alt="<?= $restaurant->name ?>">
        </div>
        <div class="col-md-3">
            <img src="<?= $photos[2] ?>" alt="<?= $restaurant->name ?>">
        </div>
        <div class="col-md-3">
            <img src="<?= $photos[3] ?>" alt="<?= $restaurant->name ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="col-md-1">
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
            </div>
            <div class="col-md-1">
                <h4>Prices:</h4>
                <p>Adult <?= $session->sessionPrice ?> €</p>
                <p>Under 12 <?= $session->reducedPrice ?> €</p>
            </div>
        </div>
        <div class="col-md-3">
            <p>Location</p>
            <p><?= $restaurant->address ?></p>
        </div>
        <div class="col-md-3">
            <p>Dietary</p>
            <p><?= $restaurant->dietary ?></p>
            <p>Cuisines</p>
            <p><?= $restaurant->cuisines ?></p>
        </div>
    </div>
</div>

<-- reservation form -->
<div class="container" id="reservationForm">
    <form method="post" action="/add/reservation">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
            <label for="adults">Number of adults:</label>
            <input type="number" id="adults" name="adults" min="1" max="10" required placeholder="Number of Adults"><br>
        </div>
        <div class="form-group">
            <label for="under12">Number of children under 12:</label>
            <input type="number" id="under12" name="under12" min="0" max="10" required placeholder="Number of children under 12"><br>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
        <div class="form-group">
            <label for="session">Session:</label>
            <select id="session" name="session" required>
                <option value="">Select a session</option>
                //TODO add the sessions from the database
                <option value="session1"></option>
                <option value="session2"></option>
                <option value="session3"></option>
                <option value="session4"></option>
            </select>
        </div>
        <div class="form-group">
            <label for="comments">Extra requests:</label>
            <textarea id="comments" name="comments" rows="4" cols="40"></textarea><br>
        </div>
        <br>
        <button type="submit" name="addReservation" class="btn btn-primary">Submit</button>
    </form>

</div>




</body>


<?php include __DIR__ . '/../footer.php'; ?>
