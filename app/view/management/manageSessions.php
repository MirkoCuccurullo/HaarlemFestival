<?php
include __DIR__ . '/../header.php'; ?>

<h1 class="text-center mb-3">Manage Sessions</h1>
<select name="restaurants" id="restaurants" class="form-select" oninput="filterSession()">
    <option selected value="0"> All Restaurants</option>
    //TODO: To do dynamically from the database
    <option value="Restaurant ML">To do Dynamically</option>

</select>

<div class="table table-responsive">
    <table class="table text-center">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Start Time</th>
            <th scope="col">End Time</th>
            <th scope="col">Date</th>
            <th scope="col">Capacity</th>
            <th scope="col">Restaurant ID</th>
            <th scope="col">Reservation Price</th>
            <th scope="col">Session Price</th>
            <th scope="col">Delete</th>
            <th scope="col">Edit</th>

        </tr>
        </thead>
        <tbody class="table-group-divider" id="sessionTable">

        <script>
            function filterSession(){
                const restaurant = document.getElementById("restaurants").value;
                const table = document.getElementById("sessionTable");
                const rows = table.getElementsByTagName("tr");
                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const restaurantCol = row.getElementsByTagName("td")[4];
                    if (restaurantCol) {
                        const restaurantValue = restaurantCol.textContent || restaurantCol.innerText;
                        if (restaurant === "0" || restaurantValue === restaurant) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    }
                }
            }
            function loadSessions() {
                fetch('http://localhost/api/session')
                    .then(result => result.json())
                    .then((sessions)=>{
                        sessions.forEach(session => {
                            appendSessions(session);
                        })
                        console.log(sessions);
                    })
            }

            function appendSessions(session)
            {
                const newRow = document.createElement("tr");
                const idCol = document.createElement("th");
                const startTimeCol = document.createElement("td");
                const endTimeCol = document.createElement("td");
                const dateCol = document.createElement("td");
                const capacityCol = document.createElement("td");
                const restaurantCol = document.createElement("td");
                const reservationPriceCol = document.createElement("td");
                const sessionPriceCol = document.createElement("td");
                const deleteButtonCol = document.createElement("td");
                const editButtonCol = document.createElement("td");
                const deleteButton = document.createElement("button")
                const editButton = document.createElement("button")
                const editForm = document.createElement("form");
                const idInput = document.createElement("input");
                editForm.method = "POST";
                editForm.action = "/edit/session";

                deleteButton.className = "btn btn-danger";
                editButton.className = "btn btn-warning";
                deleteButton.type = "button";
                editButton.type = "submit";
                idCol.scope = "row";
                idInput.type = "hidden";


                idInput.name = "id";
                idInput.value = session.id;
                idCol.innerHTML = session.id;
                startTimeCol.innerHTML = session.startTime;
                endTimeCol.innerHTML = session.endTime;
                dateCol.innerHTML = session.date;
                capacityCol.innerHTML = session.capacity;
                restaurantCol.innerHTML = session.restaurantId;
                reservationPriceCol.innerHTML = session.reservationPrice;
                sessionPriceCol.innerHTML = session.sessionPrice;
                deleteButton.innerHTML = "Delete";
                editButton.innerHTML = "Edit";

                deleteButton.addEventListener('click', function ()
                {
                    deleteSession(session.id);
                    table.removeChild(newRow);
                })

                editForm.appendChild(editButton);
                editForm.appendChild(idInput);

                deleteButtonCol.appendChild(deleteButton);
                editButtonCol.appendChild(editForm);

                newRow.appendChild(idCol);
                newRow.appendChild(startTimeCol);
                newRow.appendChild(endTimeCol);
                newRow.appendChild(dateCol);
                newRow.appendChild(capacityCol);
                newRow.appendChild(restaurantCol);
                newRow.appendChild(reservationPriceCol);
                newRow.appendChild(sessionPriceCol);
                newRow.appendChild(deleteButtonCol);
                newRow.appendChild(editButtonCol);

                const table = document.getElementById("sessionTable");
                table.appendChild(newRow);
            }

            function deleteSession(sessionId) {

                const obj = {id: sessionId};
                fetch('http://localhost/api/delete/session', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(obj),
                }).then(result => {
                    console.log(result)
                });
            }

            loadSessions();
        </script>
        </tbody>
    </table>
</div>


<?php
include __DIR__ . '/../footer.php'; ?>