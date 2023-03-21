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


