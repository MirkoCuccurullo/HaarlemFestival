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
                const idInput3 = document.createElement("input")
                const editForm = document.createElement("form");
                const idInput = document.createElement("input");
                const idInput2 = document.createElement("input");
                //Create form element for the invoice button
                const invoiceForm = document.createElement("form");
                const deleteForm = document.createElement("form");

                deleteForm.action = '/delete/order';
                deleteForm.method = "POST";
                editForm.action = '/edit/order';
                editForm.method = "POST";
                //Set the action and method for the invoice button
                invoiceForm.method = "POST";
                idInput3.type = "hidden";
                idInput3.value = order.id;
                idInput3.name = "id";

                idInput2.type = "hidden";
                idInput2.value = order.id;
                idInput2.name = "id";

                //Create the invoice button
                invoiceButton.className = "btn btn-primary";
                deleteButton.className = "btn btn-danger";
                editButton.className = "btn btn-warning";
                deleteButton.type = "submit";
                editButton.type = "submit";

                //TODO for Aizaz: generate invoice from order
                //Set the type of the invoice button
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

                deleteForm.appendChild(idInput2);
                deleteButtonCol.appendChild(deleteForm);
                deleteForm.appendChild(deleteButton);

                editForm.appendChild(editButton);
                editForm.appendChild(idInput3);
                editButtonCol.appendChild(editForm);
                //Add the invoice button to the invoice form
                invoiceButtonCol.appendChild(invoiceButton);
                invoiceButtonCol.appendChild(idInput);

                deleteButton.addEventListener("click", function() {
                    if (confirm("Are you sure you want to deactivate this reservation?")) {
                        table.removeChild(newRow);
                        // If the user confirms, submit the form
                        deleteForm.submit();
                    }
                });
                //Add event listener to the invoice button
                invoiceButton.addEventListener("click", function(){
                    window.open('/invoice.pdf', '_blank');
                });

                //add the invoice form to the invoice button column
                invoiceButtonCol.appendChild(invoiceForm);

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

            function deleteOrder(id) {
                fetch('http://localhost/api/order/' + id, {
                    method: 'DELETE',
                })
                    .then(result => result.json())
                    .then((orders)=>{
                        console.log(orders);
                    })
            }

        </script>
        </tbody>
    </table>
</div>



<?php include __DIR__ . '/../footer.php'; ?>

