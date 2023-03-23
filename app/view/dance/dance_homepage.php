<?php
include __DIR__ . '/../header_dance.php'; ?>




<div class="container">
    <h2><b><p class="mt-3">Lineup</p></b></h2>
    <div id="lineup" class="row my-5">

            <?php
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
                    <h1 class="card-title" style="color: #FFFFFF">All-days pass</h1>
                    <p>Enjoy all three days of the DANCE! music festival</p>
                    <p>Price: €250</p>
                    <form method="post" action="/shoppingCart/add">
                        <input type="hidden" name="accessPassId" value="1">
                        <button class="btn btn-primary" name="addAccessPass">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-light">
                <div class="card-body">
                    <h1 class="card-title" style="color: #FFFFFF">Day-1 pass</h1>
                    <p>Access to all day one events</p>
                    <p>Artists performing on day one:</p>
                    <ul style="color: #FFFFFF">
                        <li>Afrojack B2B Nicky Romero</li>
                        <li>Tiesto</li>
                        <li>Hardwell</li>
                        <li>Armin van Buuren</li>
                        <li>Martin Garrix</li>
                    </ul>
                    <p>Price: €150</p>
                    <form method="post" action="/shoppingCart/add">
                        <input type="hidden" name="accessPassId" value="2">
                        <button class="btn btn-primary" name="addAccessPass">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-light">
                <div class="card-body">
                    <h1 class="card-title" style="color: #FFFFFF">Day-2 pass</h1>
                    <p>Access to all day two events</p>
                    <p>Artists performing on day two:</p>
                    <ul style="color: #FFFFFF">
                        <li>Martin Garrix B2B Armin van Buuren B2B Hardwell</li>
                        <li>Armin van Buuren</li>
                        <li>Afrojack</li>
                        <li>Nicky Romero</li>
                    </ul>
                    <p>Price: €150</p>
                    <form method="post" action="/shoppingCart/add">
                        <input type="hidden" name="accessPassId" value="3">
                        <button class="btn btn-primary" name="addAccessPass">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-light">
                <div class="card-body">
                    <h1 class="card-title" style="color: #FFFFFF">Day-3 pass</h1>
                    <p>Access to all day three events</p>
                    <p>Artists performing on day three:</p>
                    <ul style="color: #FFFFFF">
                        <li>Afrojack B2B Tiesto B2B Armin van Buuren</li>
                        <li>Tiesto</li>
                        <li>Hardwell</li>
                        <li>Armin van Buuren</li>
                        <li>Martin Garrix</li>
                    </ul>
                    <p>Price: €150</p>
                    <form method="post" action="/shoppingCart/add">
                        <input type="hidden" name="accessPassId" value="4">
                        <button class="btn btn-primary" name="addAccessPass">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <h2><b><p class="mt-3">Tickets</p></b></h2>

        <div class="card border-light my-4">
            <div class="row m-3">
                <div class="col-3">
                    <select name="venue" id="venue" class="form-select" oninput="filterEventsByDate()">
                        <option selected value="0"> All Days</option>
                        <option value="28/03/2023">Day 1</option>
                        <option value="29/03/2023">Day 2</option>
                        <option value="30/03/2023">Day 3</option>
                    </select>
                </div>
                <div class="col-3">
                    <select name="date" id="date" class="form-select" oninput="filterEventsByArtist()">
                        <option selected value="0"> All Locations</option>
                        <?php foreach ($venues as $venue) { ?>
                        <option value="<?= $venue->id?>"><?= $venue->name?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-3">
                    <select name="artist" id="artist" class="form-select" oninput="filterEventsByArtist()">
                        <option selected value="0"> All Artists</option>
                        <?php foreach ($artists as $artist) { ?>
                            <option value="<?= $artist->id?>"><?= $artist->name?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

    <div id="tickets" class="row">

        <?php
            foreach ($events as $event) {
                $venue = $eventService->getVenueByID($event->location);
                $artist = $eventService->getArtistByID($event->artist);
                ?>
                    <div class="col-3 m-3">
        <div class="card border-light my-3" id="ticket_card" style="width: 18rem;">
                <img id="ticket_image" src="<?= $artist->picture ?>" class="card-img m-3" alt="...">
                <div class="card-body ">
                    <h5 class="card-title"><p><?php echo $artist->name . " @ " . $venue->name; ?></p></h5>

                <ul id="ticket_text" class="list-group list-group-flush">
                    <li class="list-group-item">Date: <?= $event->date ?> </li>
                    <li class="list-group-item">From: <?= $event->start_time ?></li>
                    <li class="list-group-item">To: <?= $event->end_time ?></li>
                    <li class="list-group-item">Session: <?= $event->session?></li>
                    <li class="list-group-item">Price: <?= $event->price ?> €</li>
                </ul>
                </div>
                <div class="card-body">
                    <form method="post" action="/shoppingCart/add">
                        <input type="hidden" name="danceEventId" value="<?= $event->id ?>">
                        <button class="btn btn-primary" name="addDanceEvent">Add to cart</button>
                    </form>
                </div>
        </div>
                    </div>


            <?php
            }
        ?>

    </div>

    <script>
        loadData();
        function loadData() {
            const articleDiv = document.getElementById('tickets');
            articleDiv.innerHTML = '';

            fetch('http://localhost/api/dance/events')
                .then(result => result.json())
                .then((events)=>{
                    events.forEach(event => {
                        appendEvent(event);
                    })
                })
        }

        function appendEvent(event){
            var eventDiv = document.getElementById('tickets');
            var eventCol = document.createElement('div');

            eventCol.className = 'col-3 m-3';
            var eventCard = document.createElement('div');
            eventCard.className = 'card border-light my-3';
            eventCard.style.width = '18rem';
            eventCard.id = 'ticket_card';
            var eventImage = document.createElement('img');
            eventImage.className = 'card-img m-3';
            eventImage.src = event.artist_picture;
            eventImage.id = 'ticket_image';
            var eventBody = document.createElement('div');
            eventBody.className = 'card-body';
            var eventTitle = document.createElement('h5');
            eventTitle.className = 'card-title';
            var eventTitleText = document.createElement('p');
            eventTitleText.innerHTML = event.artist_name + " @ " + event.venue_name;
            var eventList = document.createElement('ul');
            eventList.className = 'list-group list-group-flush';
            eventList.id = 'ticket_text';
            var eventDate = document.createElement('li');
            eventDate.className = 'list-group-item';
            eventDate.innerHTML = 'Date: ' + event.date;
            var eventStart = document.createElement('li');
            eventStart.className = 'list-group-item';
            eventStart.innerHTML = 'From: ' + event.start_time;
            var eventEnd = document.createElement('li');
            eventEnd.className = 'list-group-item';
            eventEnd.innerHTML = 'To: ' + event.end_time;
            var eventSession = document.createElement('li');
            eventSession.className = 'list-group-item';
            eventSession.innerHTML = 'Session: ' + event.session;
            var eventPrice = document.createElement('li');
            eventPrice.className = 'list-group-item';
            eventPrice.innerHTML = 'Price: ' + event.price + ' €';
            var eventButton = document.createElement('button');
            eventButton.className = 'btn btn-primary';
            eventButton.innerHTML = 'Add to cart';
            eventButton.style = 'width: 60%; margin-left: 20%; margin-bottom: 5%;';

            eventTitle.appendChild(eventTitleText);
            eventBody.appendChild(eventTitle);
            eventList.appendChild(eventDate);
            eventList.appendChild(eventStart);
            eventList.appendChild(eventEnd);
            eventList.appendChild(eventSession);
            eventList.appendChild(eventPrice);
            eventBody.appendChild(eventList);
            eventCard.appendChild(eventImage);
            eventCard.appendChild(eventBody);
            eventCard.appendChild(eventButton);
            eventCol.appendChild(eventCard);
            eventDiv.appendChild(eventCol);

        }


        function filterEventsByArtist(){
            var artist = document.getElementById('artist').value;
            var date = document.getElementById('date').value;
            var venue = document.getElementById('venue').value;
            const articleDiv = document.getElementById('tickets');
            articleDiv.innerHTML = '';




           fetch('http://localhost/api/dance/events?artist=' + artist + '&date=' + date + '&venue=' + venue)
                .then(result => result.json())
                .then((events)=>{
                    events.forEach(event => {
                        appendEvent(event);
                    })
                })
        }
    </script>

    <?php
include __DIR__ . '/../footer.php'; ?>

    <script>changeFooterToDanceStyle();
        function changeFooterToDanceStyle() {
            document.getElementById("footer").style.backgroundColor = "#d9d9d9";

        }

        function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
        function bottomFunction() {
            document.body.scrollTop = 1000; // For Safari
            document.documentElement.scrollTop = 1000; // For Chrome, Firefox, IE and Opera
        }
        function middleFunction() {
            document.body.scrollTop = 500; // For Safari
            document.documentElement.scrollTop = 500; // For Chrome, Firefox, IE and Opera
        }
    </script>


