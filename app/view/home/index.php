<?php
include __DIR__ . '/../header.php'; ?>

<head>
    <link href="css/style_index.css" rel="stylesheet">
    <title>Index</title>
</head>

    <div id="card-container">
<div class="card">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">History Tours in Haarlem</h5>
        <p class="card-text">Explore the historical sites of Haarlem. It is one of the oldest cities of the Netherlands, dating back to the 10th century. Join the history events taking place in Haarlem. These events are geared towards everyone, whether they are history enthusiasts, researchers, historians, families, and so forth. Visit us and broaden your horizons.
        </p>
        <br>
        <a href="#" class="btn-primary">History</a>
    </div>
</div>

<div class="card">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">Music clubs in Haarlem</h5>
        <p class="card-text">Haarlem is a young, bold and very alive city. The vicinity with Amsterdam influences a lot the musical culture of the people here. Although the dimension are smaller as the Dutch capital, in Haarlem it is possible to find the right event for every musical taste, from blues to techno.
        </p>
        <br>
        <a href="#" class="btn-primary">Music</a>
    </div>
</div>

    <div class="card">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Kids events in Haarlem</h5>
            <p class="card-text">Haarlem is a young, bold and very alive city. The vicinity with Amsterdam influences a lot the musical culture of the people here. Although the dimension are smaller as the Dutch capital, in Haarlem it is possible to find the right event for every musical taste, from blues to techno.
            </p>
            <br>
            <a href="#" class="btn-primary">Kids</a>
        </div>
    </div>

    <div class="card">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Culinary events in Haarlem</h5>
            <p class="card-text">Haarlem is a young, bold and very alive city, the vicinity with Amsterdam influences a lot the musical culture of the people here, altough the dimension are smaller as the Dutch capital, in Haarlem is possible to find the right event for every musical taste, from blues to techno.
            </p>
            <br>
            <a href="#" class="btn-primary">Culinary</a>
        </div>
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