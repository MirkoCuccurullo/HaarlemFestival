<?php
include __DIR__ . '/../header_dance.php';
require_once __DIR__ . '/../../model/artist.php';
require_once __DIR__ . '/../../model/dance.php';
?>

<div class="container">




<form action="/festival/dance" method="post">
    <button type="submit" class="btn btn-outline-light m-3 ">Back</button>
</form>

    <h2 class="m-2">
        <p>
            <?php echo $artist->name; ?>
        </p>
    </h2>

<div class="row">
    <div class="col-md-6">
        <img src="<?php echo $artist->picture; ?>" alt="artist picture" style="height: 250px; width: 250px;" class="img-fluid m-3">
    </div>
    <div class="col-md-6">
        <p>
            Genre: <?php echo $artist->genre; ?>
        </p> <br>
        <p>
            <?php echo $artist->description; ?>
        </p>
    </div>
    <h2> <p> Listen to a sample of his music on Spotify</p></h2>
    <div>
        <?php
        $artist_spotify_array = explode("/", $artist->spotify);
        $artist_spotify_code = $artist_spotify_array[4];
        ?>
        <iframe class="m-3" style="border-radius:12px; width: 35%" src="https://open.spotify.com/embed/artist/<?= $artist_spotify_code ?>?utm_source=generator&theme=0" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
    </div>
    <div>
        <h2 class="m-3">
            <p>
                Scheduled Events
            </p>
        </h2>
       <div class="card m-3 border-light">
           <div class="row m-2">
               <?php
               $scheduledEvents = $artist->getScheduledEvents();
               foreach ($scheduledEvents as $scheduledEvent) {?>
                       <div class="col-4">


                       <h3><p><?= $artist->name . " @ " . $scheduledEvent->venue_name ?></p></h3>
               <p>
                   Date:  <?php echo $scheduledEvent->date; ?>
               </p>
                <p>
                    From <?php echo $scheduledEvent->start_time; ?> to <?php echo $scheduledEvent->end_time; ?>
                </p>
                <p>
                    Price: <?php echo $scheduledEvent->price; ?>
                </p>
                           <form method="post" action="/shoppingCart/add">
                               <input type="hidden" name="danceEventId" value="<?= $scheduledEvent->id ?>">
                               <button class="btn btn-primary" name="addDanceEvent">Add to cart</button>
                           </form>
                       </div>
               <?php }?>
           </div>
       </div>
    </div>
</div>
    <?php
    include __DIR__ . '/../footer.php'; ?>

    <script>
        changeFooterToDanceStyle();
        function changeFooterToDanceStyle() {
            document.getElementById("undernavbar").remove();
            document.getElementById("footer").style.backgroundColor = "#d9d9d9";

        }
    </script>

