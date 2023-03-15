<?php
include __DIR__ . '/../header_dance.php'; ?>

<div class="container">
    <h2><b><p class="mt-3">Lineup</p></b></h2>
    <div id="lineup" class="row my-5">

            <?php
            require_once __DIR__ . "/../../model/artist.php";
            require_once __DIR__ . "/../../service/eventService.php";

            $eventService = new EventService();
            $artists = $eventService->getArtists();
            foreach ($artists as $artist) { ?>
                <div class="col-2">
                <form>
                    <button formmethod="post" style="background: #363636; border-style: hidden; border-radius: 50%; width: 150px;" name="id" value="<?=$artist->id?>" formaction="/dance/artist">
                        <img src="<?= $artist->picture ?>" class="hover-shadow">
                        <p class="text-center"><?= $artist->name ?></p>
                    </button>
                </form>
                </div>
            <?php } ?>

    </div>
    <h2><b><p class="mt-3">All-Access-Passes</p></b></h2>
    <div id="all_access" class="row">
        <div class="col-md-3">
            <div class="card border-light">
                <div class="card-body">
                    <p> this is a pass</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-light">
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-light">
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-light">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <h2><b><p class="mt-3">Tickets</p></b></h2>
    <div id="tickets" class="row">



        <?php
            require_once __DIR__ . '/../../model/dance.php';
            require_once __DIR__ . '/../../model/venues.php';
            require_once __DIR__ . '/../../model/artist.php';
            require_once __DIR__ . '/../../service/eventService.php';

            $eventService = new EventService();
            $events = $eventService->getAllEvents();

            foreach ($events as $event) {
                $venue = $eventService->getVenueByID($event->location);
                $artist = $eventService->getArtistByID($event->artist);
                ?>
                    <div class="col-3">
        <div class="card border-light my-7" style="width: 18rem;">
                <img src="<?= $venue->picture ?>" class="card-img" alt="...">
                <div class="card-body ">
                    <h5 class="card-title"><p><?php echo $artist->name . " @ " . $venue->name; ?></p></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Date: <?= $event->date ?> </li>
                    <li class="list-group-item">From: <?= $event->start_time ?></li>
                    <li class="list-group-item">To: <?= $event->end_time ?></li>
                    <li class="list-group-item">Price: <?= $event->price ?> €</li>
                </ul>
                <div class="card-body">
                    <button formaction="/addToChart" class="btn btn-primary">Add to cart</button>
                </div>
        </div>
                    </div>
            <?php
            }
        ?>

    </div>


<?php
include __DIR__ . '/../footer.php'; ?>

    <script>
        changeFooterToDanceStyle();
        function changeFooterToDanceStyle() {
            document.getElementById("footer").style.backgroundColor = "#363636";
            document.getElementById("company_name").style.color = "white";
            document.getElementById("facebook").style.color = "white";
            document.getElementById("instagram").style.color = "white";
            document.getElementById("linkedin").style.color = "white";
        }
    </script>
