<?php
include __DIR__ . '/../header_dance.php'; ?>

<div class="container">
    <h2><b><p class="mt-3">Lineup</p></b></h2>
    <div id="lineup" class="row my-5">
        <div class="column">
            <img src="/images/huge_avatar.jpg" class="hover-shadow">
            <p class="text-center"> Martin Garrix </p>
        </div>
        <div class="column">
            <img src="/images/huge_avatar.jpg" class="hover-shadow">
            <p class="text-center"> Martin Garrix </p>
        </div>
        <div class="column">
            <img src="/images/huge_avatar.jpg" class="hover-shadow">
            <p class="text-center"> Martin Garrix </p>
        </div>
        <div class="column">
            <img src="/images/huge_avatar.jpg" class="hover-shadow">
            <p class="text-center"> Martin Garrix </p>
        </div>
        <div class="column">
            <img src="/images/huge_avatar.jpg" class="hover-shadow">
            <p class="text-center"> Martin Garrix </p>
        </div>        <div class="column">
            <img src="/images/huge_avatar.jpg" class="hover-shadow">
            <p class="text-center"> Martin Garrix </p>
        </div>        <div class="column">
            <img src="/images/huge_avatar.jpg" class="hover-shadow">
            <p class="text-center"> Martin Garrix </p>
        </div>        <div class="column">
            <img src="/images/huge_avatar.jpg" class="hover-shadow">
            <p class="text-center"> Martin Garrix </p>
        </div>
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

        <div class="card border-light my-7" style="width: 18rem;">

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
                <img src="<?= $venue->picture ?>" class="card-img" alt="...">
                <div class="card-body ">
                    <h5 class="card-title"><p><?php echo $artist->name . " @ " . $venue->name; ?></p></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Date: <?= $event->date ?> </li>
                    <li class="list-group-item">From: <?= $event->start_time ?></li>
                    <li class="list-group-item">To: <?= $event->end_time ?></li>
                    <li class="list-group-item">Price: <?= $event->price ?> $</li>
                </ul>
                <div class="card-body">
                    <button formaction="/addToChart" class="btn btn-primary">Add to cart</button>
                </div>
            <?php
            }
        ?>
        </div>
    </div>


<?php
include __DIR__ . '/../footer.php'; ?>
