<?php
include __DIR__ . '/../header.php'; ?>

<h1 class="text-center mb-3">Dance Events</h1>
<select name="role" id="role" class="form-select" oninput="filterUsers()">
    <option selected value="0"> All Roles</option>
    <option value="Employee">Employee</option>
    <option value="Customer">Customer</option>
    <option value="Administrator">Administrator</option>
</select>

<div class="table table-responsive">
    <table class="table text-center">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Event Name</th>
            <th scope="col">Date</th>
            <th scope="col">Start Time</th>
            <th scope="col">End Time</th>
            <th scope="col">Session</th>
            <th scope="col">Delete</th>
            <th scope="col">Edit</th>
        </tr>
        </thead>
        <tbody class="table-group-divider" id="userTable">

        <script>
            function filterUsers(){
                const role = document.getElementById("role").value;
                const table = document.getElementById("userTable");
                const rows = table.getElementsByTagName("tr");
                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const roleCol = row.getElementsByTagName("td")[4];
                    if (roleCol) {
                        const roleValue = roleCol.textContent || roleCol.innerText;
                        if (role === "0" || roleValue === role) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    }
                }
            }
            function loadEvents() {
                fetch('http://localhost/api/dance/events')
                    .then(result => result.json())
                    .then((events)=>{
                        events.forEach(events => {
                            appendDoctor(events);
                        })
                        console.log(events);
                    })
            }

            function appendDoctor(event)
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
                editForm.action = "/edit/dance/event";

                deleteButton.className = "btn btn-danger";
                editButton.className = "btn btn-warning";
                deleteButton.type = "button";
                editButton.type = "submit";
                idCol.scope = "row";
                idInput.type = "hidden";

                idInput.name = "id";
                idInput.value = event.id;
                idCol.innerHTML = event.id;
                nameCol.innerHTML = event.artist_name + " @ " + event.venue_name;
                roleCol.innerHTML = 'session';
                emailCol.innerHTML = event.date;
                dateOfBirthCol.innerHTML = event.start_time;
                regDateCol.innerHTML = event.end_time;
                deleteButton.innerHTML = "Delete";
                editButton.innerHTML = "Edit";

                deleteButton.addEventListener('click', function ()
                {
                    deleteDoctor(event.id);
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
                fetch('http://localhost/api/delete/dance/event', {
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



