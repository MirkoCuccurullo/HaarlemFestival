<?php include __DIR__ . '/../header.php'; ?>

<head>
    <link href="../../public/css/style_food.css" rel="stylesheet">
    <title>Index</title>
</head>

<div id="restaurant-container">
    <?php foreach ($restaurants as $restaurant): ?>
        <div class="restaurant-card">
            <!-- Restaurant name and photo -->
            <div class="restaurant-name">
                <h3><?= $restaurant->name ?></h3>
                <img src="<?= $restaurant->photo ?>" alt="<?= $restaurant->name ?>">
            </div>

            <!-- Restaurant description -->
            <div class="restaurant-description">
                <p><?= $restaurant->description ?></p>
            </div>

            <!-- Cuisines and dietary information -->
            <div class="restaurant-info">
                <div class="restaurant-cuisines">
                    <h4>Cuisines:</h4>
                    <p><?= $restaurant->cuisines ?></p>
                </div>
                <div class="restaurant-dietary-info">
                    <h4>Dietary Information:</h4>
                    <p><?= $restaurant->dietary?></p>
                </div>
            </div>

            <!-- Session times -->
            <div class="restaurant-sessions">
                <h4>Session Times:</h4>
                <ul>
                    <?php foreach ($restaurant->sessions as $session): ?>
                        <li><?= $session->startTime ?> - <?= $session->endTime ?></li>
                    <?php endforeach; ?>
                </ul>
                <!-- add a button here to reserve -->

            </div>
        </div>

        <br>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
