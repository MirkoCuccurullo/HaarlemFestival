<?php
include __DIR__ . '/../header.php'; ?>

<h1 class="text-center mb-3">Artists</h1>
<form action="/add/artist" class="my-2">
    <button formmethod="post" class="btn btn-primary"> Add Artist </button>
</form>

<div class="table table-responsive">
    <table class="table text-center">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Genre</th>
            <th scope="col">Description</th>
            <th scope="col">To remove</th>
            <th scope="col">To remove</th>
            <th scope="col">Delete</th>
            <th scope="col">Edit</th>
        </tr>
        </thead>
        <tbody class="table-group-divider" id="userTable">

        <script>
            function loadEvents() {
                fetch('http://localhost/api/dance/artists')
                    .then(result => result.json())
                    .then((artists)=>{
                        artists.forEach(artists => {
                            appendDoctor(artists);
                        })
                        console.log(artists);
                    })
            }

            function appendDoctor(artist)
            {
                const newRow = document.createElement("tr");
                const idCol = document.createElement("th");
                const nameCol = document.createElement("td");
                const emailCol = document.createElement("td");
                const dateOfBirthCol = document.createElement("td");
                const roleCol = document.createElement("td");
                const regDateCol = document.createElement("td");
                const deleteButtonCol = document.createElement("td");
                const editButtonCol = document.createElement("td");
                const deleteButton = document.createElement("button")
                const editButton = document.createElement("button")
                const editForm = document.createElement("form");
                const idInput = document.createElement("input");
                editForm.method = "POST";
                editForm.action = "/edit/dance/artist";

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

            function deleteDoctor(eventId) {

                const obj = {id: eventId};
                fetch('http://localhost/api/delete/dance/artist', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(obj),
                }).then(result => {
                    console.log(result)
                });
            }

            loadEvents();
        </script>
        </tbody>
    </table>
</div>

<?php
include __DIR__ . '/../footer.php'; ?>



