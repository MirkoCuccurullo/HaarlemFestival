<?php
include __DIR__ . '/../header.php'; ?>

<head>
    <link href="css/style_index.css" rel="stylesheet">
    <title>Index</title>
</head>

<div id="card-container">
    <?php
    foreach ($homePage as $item): ?>
        <div class="card">
            <img class="card-img-top" src="<?= $item['image'] ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?= $item['title'] ?></h5>
                <p class="card-text"><?= $item['content'] ?></p>
                <br>
                <a href="<?= $item['prompt'] ?>" class="btn-primary"><?= $item['prompt'] ?></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</div>

    <div id="instafeed"></div>

    <h3 style="text-align: center">Instagram:</h3>
    <div id="instafeed-container"></div>
    <script src="https://cdn.jsdelivr.net/gh/stevenschobert/instafeed.js@2.0.0rc1/src/instafeed.min.js"></script>
    <script type="text/javascript">
        var userFeed = new Instafeed({
            get: 'user',
            target: "instafeed-container",
            resolution: 'low_resolution',
            accessToken: 'IGQVJYQUI5MlBBVF9hZA3RzWHBPQWg4NUxURERaN3V5OHNKMkRuVUg5enhrMTNsYWdNMzdrb3dwLVZAPZAFE5V2dCaFE2R3gwT0ZA2VXlzbjVzR3I4MnY4NTRPZA2FfdUVSd3M3OFQzSE54ZAlpGQVE5a2JHNwZDZD'
        });
        userFeed.run();
    </script>

    </div>

<?php
include __DIR__ . '/../footer.php'; ?>
