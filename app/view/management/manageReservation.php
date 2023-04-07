<?php include __DIR__ . '/../header.php'; ?>

<h1 class="text-center mb-3">Manage Reservations</h1>
<br>

<div class="table table-responsive">
    <table class="table text-center">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Restaurant Name</th>
            <th scope="col">Session Id</th>
            <th scope="col">Status</th>
            <th scope="col">Nr of adults</th>
            <th scope="col">Nr of under 12</th>
            <th scope="col">Reservation Price</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Customer Email</th>
            <th scope="col">Comment</th>
            <th scope="col">Deactivate</th>
            <th scope="col">Edit</th>
        </tr>
        </thead>
        <tbody class="table-group-divider" id="reservationTable">

        <script>
            function loadReservations() {
                fetch('http://localhost/api/reservation')
                    .then(result => result.json())
                    .then((reservations) => {
                        reservations.forEach(reservation => {
                            appendReservation(reservation);
                        })
                        console.log(reservations);
                    })
            }

            function appendReservation(reservation) {
                const newRow = document.createElement("tr");
                const idCol = document.createElement("th");
                const restaurantNameCol = document.createElement("td");
                const sessionIdCol = document.createElement("td");
                const statusCol = document.createElement("td");
                const adultCol = document.createElement("td");
                const under12Col = document.createElement("td");
                const reservationPriceCol = document.createElement("td");
                const customerNameCol = document.createElement("td");
                const customerEmailCol = document.createElement("td");
                const commentCol = document.createElement("td");
                const deactivateButtonCol = document.createElement("td");
                const editButtonCol = document.createElement("td");
                const deactivateForm = document.createElement("form");
                const editForm = document.createElement("form");
                const deactivateButton = document.createElement("button");
                const idInputTwo = document.createElement("input");
                const editButton = document.createElement("button");
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
                idInputTwo.type = "hidden";

                idInput.name = "id";
                idInputTwo.name = "id";
                idInput.value = reservation.id;
                idInputTwo.value = reservation.id;
                idCol.innerHTML = reservation.id;
                restaurantNameCol.innerHTML = reservation.restaurantName;
                sessionIdCol.innerHTML = reservation.sessionId;
                statusCol.innerHTML = reservation.status;
                adultCol.innerHTML = reservation.numberOfAdults;
                under12Col.innerHTML = reservation.numberOfUnder12;
                reservationPriceCol.innerHTML = reservation.price;
                customerNameCol.innerHTML = reservation.customerName;
                customerEmailCol.innerHTML = reservation.customerEmail;
                commentCol.innerHTML = reservation.comment;


                deactivateButton.innerHTML = "Deactivate";
                editButton.innerHTML = "Edit";

                deactivateForm.appendChild(idInputTwo);
                deactivateForm.appendChild(deactivateButton);
                deactivateButtonCol.appendChild(deactivateForm);

                deactivateButton.addEventListener("click", function() {
                    if (confirm("Are you sure you want to deactivate this reservation?")) {
                        // If the user confirms, submit the form
                        deactivateForm.submit();
                    }
                });

                editForm.appendChild(idInput);
                editForm.appendChild(editButton);
                editButtonCol.appendChild(editForm);

                newRow.appendChild(idCol);
                newRow.appendChild(restaurantNameCol);
                newRow.appendChild(sessionIdCol);
                newRow.appendChild(statusCol);
                newRow.appendChild(adultCol);
                newRow.appendChild(under12Col);
                newRow.appendChild(reservationPriceCol);
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

