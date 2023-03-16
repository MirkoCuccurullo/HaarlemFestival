<?php
include __DIR__ . '/../header.php'; ?>

    <head>
        <link href="../../public/css/style_food.css" rel="stylesheet">
        <title>Index</title>
    </head>

<script>

    function appendRestaurant(restaurant)
    {

    }

        function loadRestaurants() {
        fetch('http://localhost/api/restaurant')
            .then(result => result.json())
            .then((restaurants)=>{
                restaurants.forEach(restaurant => {
                    appendRestaurant(restaurant);
                })
                console.log(restaurants);
            })
    }

        function appendSession(session) {

        }

        function loadSessions() {
            fetch('http://localhost/api/session')
                .then(result => result.json())
                .then((sessions)=>{
                    sessions.forEach(session => {
                        appendSession(session);
                    })
                    console.log(sessions);
                }
    }


        loadRestaurants();
</script>

<?php
include __DIR__ . '/../footer.php'; ?>