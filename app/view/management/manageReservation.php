<?php
include __DIR__ . '/../header.php'; ?>

<h1 class="text-center mb-3">Manage Reservations</h1>
<br>
<select name="reservation" id="reservation" class="form-select" oninput="filterReservations()">
    <option selected value="0"> All Reservations</option>
    <option value=1">Confirmed</option>
    <option value="2">Canceled</option>
    <option value="3">Deactivated</option>
</select>
<br>

    <div class="table table-responsive">
    <table class="table text-center">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Restaurant Name</th>
            <th scope="col">Session Id</th>
            <th scope="col">Status</th>
            <th scope="col">Nr of adults</th>
            <th scope="col">Nr of under 12</th>
            <th scope="col">Reservation Price (paid)</th>
            <th scope="col">Reservation Date</th>
            <th scope="col">Reservation Time</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Customer Email</th>
            <th scope="col">Comment</th>
            <th scope="col">Deactivate</th>
            <th scope="col">Edit</th>

        </tr>
        </thead>
        <tbody class="table-group-divider" id="reservationTable">

        <script>
            //TODO add filter by status
            function filterReservations() {
                const status = document.getElementById("reservations").value;
                const table = document.getElementById("reservationTable");
                const rows = table.getElementsByTagName("tr");
                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const statusCol = row.getElementsByTagName("td")[4];
                    if (statusCol) {
                        const statusValue = statusCol.textContent || statusCol.innerText;
                        if (status === "0" || statusValue === status) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    }
                }
            }

                function loadReservations() {
                    fetch('http://localhost/api/reservation')
                        .then(result => result.json())
                        .then((reservations)=>{
                            reservations.forEach(reservation => {
                                appendReservation(reservation);
                            })
                            console.log(reservations);
                        })
                }

            function appendReservation(reservation)
            {

                const newRow = document.createElement("tr");
                const idCol = document.createElement("th");
                const restaurantNameCol = document.createElement("td");
                const sessionIdCol = document.createElement("td");
                const statusCol = document.createElement("td");
                const adultCol = document.createElement("td");
                const under12Col = document.createElement("td");
                const reservationPriceCol = document.createElement("td");
                const reservationDateCol = document.createElement("td");
                const reservationTimeCol = document.createElement("td");
                const customerNameCol = document.createElement("td");
                const customerEmailCol = document.createElement("td");
                const commentCol = document.createElement("td");
                const deactivateButtonCol = document.createElement("td");
                const editButtonCol = document.createElement("td");
                const deactivateButton = document.createElement("button")
                const deactivateForm = document.createElement("form");
                const editButton = document.createElement("button")
                const editForm = document.createElement("form");
                const idInput = document.createElement("input");
                editForm.action = '/edit/reservation';
                editForm.method = 'post';
                deactivateForm.action = '/deactivate/reservation';
                deactivateForm.method = 'post';

                deactivateButton.className = "btn btn-danger";
                editButton.className = "btn btn-warning";
                deactivateButton.type = "button";
                editButton.type = "submit";
                idCol.scope = "row";
                idInput.type = "hidden";

                idInput.name = "id";
                idInput.value = reservation.id;
                idCol.innerHTML = reservation.id;
                restaurantNameCol.innerHTML = reservation.restaurantName;
                sessionIdCol.innerHTML = reservation.session.id;
                statusCol.innerHTML = reservation.status;
                adultCol.innerHTML = reservation.numberOfAdults;
                under12Col.innerHTML = reservation.numberOfUnder12;
                reservationPriceCol.innerHTML = reservation.reservationPrice;
                reservationDateCol.innerHTML = reservation.session.date;
                reservationTimeCol.innerHTML = reservation.session.startTime;
                customerNameCol.innerHTML = reservation.customerName;
                customerEmailCol.innerHTML = reservation.customerEmail;
                commentCol.innerHTML = reservation.comment;
                deactivateButton.innerHTML = "Deactivate";
                editButton.innerHTML = "Edit";

               deactivateForm.appendChild(deactivateButton);
               deactivateForm.appendChild(idInput);

                editForm.appendChild(editButton);
                editForm.appendChild(idInput);

                deactivateButton.appendChild(deactivateButton);
                deactivateButtonCol.appendChild(deactivateForm);
                editButton.appendChild(editButton);
                editButtonCol.appendChild(editForm);

                newRow.appendChild(idCol);
                newRow.appendChild(restaurantNameCol);
                newRow.appendChild(sessionIdCol);
                newRow.appendChild(statusCol);
                newRow.appendChild(adultCol);
                newRow.appendChild(under12Col);
                newRow.appendChild(reservationPriceCol);
                newRow.appendChild(reservationDateCol);
                newRow.appendChild(reservationTimeCol);
                newRow.appendChild(customerNameCol);
                newRow.appendChild(customerEmailCol);
                newRow.appendChild(commentCol);
                newRow.appendChild(deactivateButtonCol);
                newRow.appendChild(editButtonCol);

                const table = document.getElementById("reservationTable");
                table.appendChild(newRow);
            }
            loadReservations();
        </script>
    </table>
    </div>

    <?php
    include __DIR__ . '/../footer.php'; ?>

