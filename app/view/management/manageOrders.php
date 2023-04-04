<?php
include __DIR__ . '/../header.php'; ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>

<h1 class="text-center mb-3">Manage Orders</h1>
<br>

 <div style="display: inline-block; margin-right: 10px;">
<form method="post" action="/saveInCSV">
    <button type="submit" class="btn btn-primary" name="saveInCSV">Download CSV file</button>
</form>
 </div>
<div style="display: inline-block;">
    <form method="post" action="/saveInExcel">
        <button type="submit" class="btn" style="background-color: green; color: white;" name="exportToExcel">Download Excel file</button>
    </form>
</div>
<br>
<br>

<div class="table table-responsive">
    <table class="table text-center">
        <thead>
        <tr>
            <th scope="col">Id</th>
    <th scope="col">User Id</th>
    <th scope="col">No of Items</th>
<th scope="col">Total Price</th>
<th scope="col">Status</th>
<th scope="col">Delete</th>
<th scope="col">Edit</th>
            <th scope="col">Invoice</th>
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
                const statusCol = document.createElement("td");
                const deleteButtonCol = document.createElement("td");
                const editButtonCol = document.createElement("td");
                const invoiceButtonCol = document.createElement("td");
                const deleteButton = document.createElement("button")
                const editButton = document.createElement("button")
                const invoiceButton = document.createElement("button")
                const test = document.createElement("input")
                const editForm = document.createElement("form");
                const idInput = document.createElement("input");
                editForm.action = '/edit/order';
                editForm.method = "POST";
                test.type = "hidden";
                test.value = order.id;
                test.name = "id";

                invoiceButton.className = "btn btn-primary";
                deleteButton.className = "btn btn-danger";
                editButton.className = "btn btn-warning";
                deleteButton.type = "button";
                editButton.type = "submit";

                //TODO for Aizaz: generate invoice from order
                invoiceButton.type = "submit";

                idCol.scope = "row";
                idInput.type = "hidden";

                idInput.name = "id";
                idInput.value = order.id;
                idCol.innerHTML = order.id;
                userIdCol.innerHTML = order.user_id;
                noOfItemsCol.innerHTML = order.no_of_items;
                totalPriceCol.innerHTML = order.total_price;
                statusCol.innerHTML = order.status;
                deleteButton.innerHTML = "Delete";
                editButton.innerHTML = "Edit";
                invoiceButton.innerHTML = "Invoice";
                editForm.appendChild(editButton);
                editForm.appendChild(idInput);
                editForm.appendChild(test);

                deleteButton.addEventListener("click", function(){
                    deleteOrder(order.id);
                    table.removeChild(newRow);
                });

                deleteButtonCol.appendChild(deleteButton);
                editButtonCol.appendChild(editForm);

                invoiceButtonCol.appendChild(invoiceButton);
                invoiceButtonCol.appendChild(idInput);

                newRow.appendChild(idCol);
                newRow.appendChild(userIdCol);
                newRow.appendChild(noOfItemsCol);
                newRow.appendChild(totalPriceCol);
                newRow.appendChild(statusCol);
                newRow.appendChild(deleteButtonCol);
                newRow.appendChild(editButtonCol);
                newRow.appendChild(invoiceButtonCol);

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


