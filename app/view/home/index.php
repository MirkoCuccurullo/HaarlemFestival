<?php
include __DIR__ . '/../header.php'; ?>

<head>
    <link href="css/style_index.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/ea8dl2qwcc0ubif5iugpqvomh1a1ftv5skra68xzeys1qabb/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <title>Index</title>
</head>

<div class="row">
    <div class="col md-6">
        <h3 class="about-header">About Haarlem</h3>
        <p>Haarlem is a lovely historical city at no more than 20 km distance from Amsterdam.
            International and Inclusive tourism seems to have recognized Haarlem’s many delights,
            and an ever-increasing number of visitors find their path here each year.
            Haarlem offers a wide range of activities from visiting museums, shopping centers, bars, restaurants, art
            galleries, parks, and many more.
        </p>
    </div>
    <div class="col md-6">
        <h3 class="about-header">About Events</h3>
        <p>Inclusiveness is the constituent for creating this website. We are dedicated to promoting the splendid city
            of Haarlem to
            a wider audience and spreading awareness of inclusion and diversity. Different categories of events
            including history, music, and culinary will be ongoing to draw a
            versatile crowd to experience all Haarlem has to offer. There are also activities for the Kids coming in
            with their families.
        </p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card-body text-center">
            <h1 class="mb-3"><strong>The Festival</strong></h1>
            <img src="images/festival-card.png" alt="festival-card" style="width: 640px; height: 400px">
            <div class="mt-4" style="margin-left: 10em; margin-right: 10em">
                <p>The Festival, will be held on four days over the summer, in July, it is meant for any kind of person,
                    of any culture. The four main points of the event are, <strong>DANCE!</strong>, a electronic music
                    festival, where
                    the most famous DJ´s will perform, <strong>YUMMY!</strong>, a food festival, <strong>History
                        tour</strong> through the city and <strong>The
                        Secret of Dr. Teyler</strong>, a treasure hunt event for kids and families.
                </p>
            </div>

            <a type="button" href="/festival" class="btn btn-primary btn-custom" >Explore events</a>

        </div>
    </div>
</div>

<div id="card-container2" class="row">
    <script>
        function appendCard(item) {
            const cardContainer = document.getElementById('card-container2');

            const container = document.createElement('div');
            container.className = 'col-md-6 my-3';
            container.style = 'display: flex; justify-content: center;';
            container.id = 'div' + item.id;

            const card = document.createElement('div');
            card.className = 'card card-body';
            card.id = item.id;

            const image = document.createElement('img');
            card.appendChild(image);
            image.outerHTML = item.image;

            const title = document.createElement('h1');
            card.appendChild(title);
            title.outerHTML = item.title;

            const content = document.createElement('p');
            card.appendChild(content);
            content.outerHTML = item.content;

            const prompt = document.createElement('a');
            card.appendChild(prompt);
            prompt.outerHTML = item.prompt;
            container.appendChild(card);

            cardContainer.appendChild(container);
        }

        function loadCards() {
            fetch('/api/homeCards')
                .then(result => result.json())
                .then((cards) => {
                    cards.forEach(item => {
                        appendCard(item);
                    })
                })
        }

        loadCards();
    </script>

</div>


<br>
<div class="text-center mb-4">
    <h1 class="about-header">Explore our instagram page!</h1>
</div>
<div id="card-container" class="text-center">
    <br>
    <div id="instafeed-container"></div>
    <script src="https://cdn.jsdelivr.net/gh/stevenschobert/instafeed.js@2.0.0rc1/src/instafeed.min.js"></script>
    <script type="text/javascript">
        var userFeed = new Instafeed({
            get: 'user',
            target: "instafeed-container",
            resolution: 'low_resolution',
            accessToken: 'IGQVJYQUI5MlBBVF9hZA3RzWHBPQWg4NUxURERaN3V5OHNKMkRuVUg5enhrMTNsYWdNMzdrb3dwLVZAPZAFE5V2dCaFE2R3gwT0ZA2VXlzbjVzR3I4MnY4NTRPZA2FfdUVSd3M3OFQzSE54ZAlpGQVE5a2JHNwZDZD',
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}" width="400"></a>'
        });
        userFeed.run();
    </script>


</div>

<?php
include __DIR__ . '/../footer.php'; ?>
