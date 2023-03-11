<?php
include __DIR__ . '/../header.php'; ?>

    <head>
        <link href="../../public/css/style_food.css" rel="stylesheet">
        <title>Index</title>
    </head>

    <--add event name and description from event table in db-->
    <!--<div id="event-description">-->
    <!--    <h1>--><?php //= $event['name'] ?><!--</h1>-->
    <!--    <p>--><?php //= $event['description'] ?><!--</p>-->
    <!--</div>-->


    <--! Display the restaurants -->
    <div id="restaurant-cards" class="container">

    </div>


<script>
    function loadEvents() {
        fetch('http://localhost/yummy')
            .then(result => result.json())
            .then((restaurants)=>{
                restaurants.forEach(restaurant => {
                    appendDoctor(restaurant);
                })
                console.log(restaurants);
            })
    }

    function appendDoctor(restaurant)
    {
        const newRow = document.createElement("tr");
        const idCol = document.createElement("th");
        const nameCol = document.createElement("td");
        const addressCol = document.createElement("td");
        const descriptionCol = document.createElement("td");


        deleteButton.className = "btn btn-danger";
        editButton.className = "btn btn-warning";
        deleteButton.type = "button";
        editButton.type = "submit";
        idCol.scope = "row";
        idInput.type = "hidden";

        idInput.name = "id";
        idInput.value = artist.id;
        idCol.innerHTML = artist.id;
        nameCol.innerHTML = artist.name;
        roleCol.innerHTML = 'session';
        emailCol.innerHTML = artist.genre;
        dateOfBirthCol.innerHTML = artist.description;
        regDateCol.innerHTML = 'nothing';
        deleteButton.innerHTML = "Delete";
        editButton.innerHTML = "Edit";

        deleteButton.addEventListener('click', function ()
        {
            deleteDoctor(artist.id);
            table.removeChild(newRow);
        })

        editForm.appendChild(editButton);
        editForm.appendChild(idInput);

        deleteButtonCol.appendChild(deleteButton);
        editButtonCol.appendChild(editForm);


        newRow.appendChild(idCol);
        newRow.appendChild(nameCol);
        newRow.appendChild(emailCol);
        newRow.appendChild(dateOfBirthCol);
        newRow.appendChild(regDateCol);
        newRow.appendChild(roleCol);
        newRow.appendChild(deleteButtonCol);
        newRow.appendChild(editButtonCol);

        const table = document.getElementById("userTable");
        table.appendChild(newRow);
    }
</script>

<?php
include __DIR__ . '/../footer.php'; ?>