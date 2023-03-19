<?php
include __DIR__ . '/../header.php'; ?>

    <head>
        <link href="../../public/css/style_food.css" rel="stylesheet">
        <title>Index</title>
    </head>

    <div id="restaurant-container">
    <div class="row">
        <div class="col-md-3">
            <!-- Column 1: Restaurants and photos -->
            <?php foreach ($restaurants as $restaurant): ?>
                <div>
                    <h3><?= $restaurant['name'] ?></h3>
                    <img src="<?= $restaurant['photo'] ?>" alt="<?= $restaurant['name'] ?>">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-3">
            <!-- Column 2: Restaurant descriptions -->
            <?php foreach ($restaurants as $restaurant): ?>
                <div>
                    <p><?= $restaurant['description'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-3">
            <!-- Column 3: Cuisines and dietary information -->
            <?php foreach ($restaurants as $restaurant): ?>
                <div>
                    <h4>Cuisines:</h4>
                    <p><?= $restaurant['cuisines'] ?></p>
                    <h4>Dietary Information:</h4>
                    <p><?= $restaurant['dietary_info'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-3">
            <!-- Column 4: Session times -->
            <?php foreach ($restaurants as $restaurant): ?>
                <div>
                    <h4>Session Times:</h4>
                    <?php foreach ($restaurant['sessions'] as $session): ?>
                        <ul>
                            <li><?= $session['startTime'] ?> - <?= $session['endTime'] ?></li>
                        </ul>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div



    </div>


<?php
include __DIR__ . '/../footer.php'; ?>