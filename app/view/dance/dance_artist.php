<?php
include __DIR__ . '/../header_dance.php';
require_once __DIR__ . '/../../model/artist.php';
require_once __DIR__ . '/../../model/dance.php';
?>

<h2 class="m-2">
    <p>
        <?php echo $artist->name; ?>
    </p>
</h2>

<div id="fb-root m-3"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v16.0" nonce="3xLLnuP1"></script>
<div class="fb-share-button m-3" data-href="https://developers.facebook.com/docs/plugins/" data-layout="" data-size=""><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>

<form action="/festival/dance" method="post">
    <button type="submit" class="btn btn-outline-light m-3 ">Back</button>
</form>

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
               <?php }?>
           </div>
       </div>
    </div>
    <?php
    include __DIR__ . '/../footer.php'; ?>

    <script>
        changeFooterToDanceStyle();
        function changeFooterToDanceStyle() {
            document.getElementById("undernavbar").remove();
            document.getElementById("footer").style.backgroundColor = "#363636";
            document.getElementById("company_name").style.color = "white";
            document.getElementById("facebook").style.color = "white";
            document.getElementById("instagram").style.color = "white";
            document.getElementById("linkedin").style.color = "white";
        }
    </script>

