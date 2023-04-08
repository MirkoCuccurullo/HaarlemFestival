<?php
include __DIR__ . '/../header.php';
?>

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-center mb-3">Manage Sessions</h1>
        <a href="/add/session" class="btn btn-success">Add new</a>
    </div>

    <div class="table table-responsive">
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th scope="col">Date</th>
                <th scope="col">Capacity</th>
                <th scope="col">Restaurant ID</th>
                <th scope="col">Reservation Price</th>
                <th scope="col">Session Price</th>
                <th scope="col">Reduced Price</th>
                <th scope="col">Delete</th>
                <th scope="col">Edit</th>

            </tr>
            </thead>
            <tbody class="table-group-divider" id="sessionTable">

            <script>

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
                    const reducedPriceCol = document.createElement("td");
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

                    const startTime = session.startTime.substring(0, 8);
                    const endTime = session.endTime.substring(0, 8);
                    const options = {hour: 'numeric', minute: 'numeric',  hour12: false};
                    const formattedStartTime = new Date(`2022-02-23T${startTime}`).toLocaleTimeString('en-US', options);
                    const formattedEndTime = new Date(`2022-02-23T${endTime}`).toLocaleTimeString('en-US', options);

                    startTimeCol.innerHTML = formattedStartTime;
                    endTimeCol.innerHTML = formattedEndTime;


                    dateCol.innerHTML = session.date;
                    capacityCol.innerHTML = session.capacity;
                    restaurantCol.innerHTML = session.restaurantId;
                    reservationPriceCol.innerHTML = session.reservationPrice;
                    sessionPriceCol.innerHTML = session.sessionPrice;
                    reducedPriceCol.innerHTML = session.reducedPrice;
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
                    newRow.appendChild(reducedPriceCol);
                    newRow.appendChild(deleteButtonCol);
                    newRow.appendChild(editButtonCol);

                    const table = document.getElementById("sessionTable");
                    table.appendChild(newRow);
                }

                function deleteSession(sessionId){

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