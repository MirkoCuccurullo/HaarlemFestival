<?php
include __DIR__ . '/../header.php'; ?>

    <head>
        <link href="../../public/css/style_food.css" rel="stylesheet">
        <title>Index</title>
    </head>

<script>
    function loadRestaurant() {
        fetch('http://localhost/yummy')
            .then(result => result.json())
            .then((restaurants)=>{
                restaurants.forEach(restaurant => {
                    appendDoctor(restaurant);
                })
                console.log(restaurants);
            })
    }



<?php
include __DIR__ . '/../footer.php'; ?>