<?php
include __DIR__ . '/../header.php'; ?>

<h1 class="text-center mb-3">Manage Orders</h1>
<br>
<div class="table table-responsive">
    <table class="table text-center">
        <thead>
        <tr>
            <th scope="col">Id</th>
    <th scope="col">User Id</th>
    <th scope="col">No of Items</th>
<th scope="col">Total Price</th>
<th scope="col">Dance Events</th>
<th scope="col">Delete</th>
<th scope="col">Edit</th>
        </tr>
        </thead>
        <tbody class="table-group-divider" id="orderTable">

        <script>
            function loadOrders() {
                fetch('http://localhost/api/order')
                    .then(result => result.json())
                    .then((orders)=>{
                        orders.forEach(order => {
                            appendOrder(order);
                        })
                        console.log(orders);
                    })
            }

            function appendOrder(order)
            {
                const newRow = document.createElement("tr");
                const idCol = document.createElement("th");
                const userIdCol = document.createElement("td");
                const noOfItemsCol = document.createElement("td");
                const totalPriceCol = document.createElement("td");
                const danceEventsCol = document.createElement("td");
                const deleteButtonCol = document.createElement("td");
                const editButtonCol = document.createElement("td");
                const deleteButton = document.createElement("button")
                const editButton = document.createElement("button")
                const editForm = document.createElement("form");
                const idInput = document.createElement("input");
                editForm.action = '/edit/order';
                editForm.method = 'post';

                deleteButton.className = "btn btn-danger";
                editButton.className = "btn btn-warning";
                deleteButton.type = "button";
                editButton.type = "submit";
                idCol.scope = "row";
                idInput.type = "hidden";

                idInput.name = "id";
                idInput.value = order.id;
                idCol.innerHTML = order.id;
                userIdCol.innerHTML = order.user_id;
                noOfItemsCol.innerHTML = order.no_of_items;
                totalPriceCol.innerHTML = order.total_price;
                danceEventsCol.innerHTML = order.dance_events;
                deleteButton.innerHTML = "Delete";
                editButton.innerHTML = "Edit";
                editForm.appendChild(idInput);
                editForm.appendChild(editButton);

                deleteButton.addEventListener("click", function(){
                    deleteOrder(order.id);
                });


                editForm.appendChild(editButton);
                editForm.appendChild(idInput);

                deleteButtonCol.appendChild(deleteButton);
                editButtonCol.appendChild(editForm);

                newRow.appendChild(idCol);
                newRow.appendChild(userIdCol);
                newRow.appendChild(noOfItemsCol);
                newRow.appendChild(totalPriceCol);
                newRow.appendChild(danceEventsCol);
                newRow.appendChild(deleteButtonCol);
                newRow.appendChild(editButtonCol);

                const table = document.getElementById("orderTable");
                table.appendChild(newRow);
            }
            loadOrders();

            function deleteOrder(eventId)
            {
                const obj = {id: eventId};
                fetch('http://localhost/api/delete/order', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(obj),
                }).then(result => {
                    console.log(result)
                });
            }
        </script>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../footer.php'; ?>


