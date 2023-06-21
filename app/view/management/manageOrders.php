<?php
include __DIR__ . '/../header.php';
?>

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
                    .then((orders) => {
                        orders.forEach(order => {
                            appendOrder(order);
                        });
                    });
            }

            function appendOrder(order) {
                const table = document.getElementById("orderTable");
                const newRow = document.createElement("tr");

                const idCol = document.createElement("th");
                const userIdCol = document.createElement("td");
                const noOfItemsCol = document.createElement("td");
                const totalPriceCol = document.createElement("td");
                const statusCol = document.createElement("td");
                const deleteButtonCol = document.createElement("td");
                const editButtonCol = document.createElement("td");
                const invoiceButtonCol = document.createElement("td");

                const deleteForm = document.createElement("form");
                const editForm = document.createElement("form");
                const invoiceForm = document.createElement("form");

                const idInput = document.createElement("input");
                const idInput2 = document.createElement("input");
                const idInput3 = document.createElement("input");

                const deleteButton = document.createElement("button");
                const editButton = document.createElement("button");
                const invoiceButton = document.createElement("button");

                const statusWrapper = document.createElement("div");
                const changeButton = document.createElement("button");
                const changeDropdown = document.createElement("div");
                const statusSelect = document.createElement("select");

                const optionEmpty = document.createElement("option");
                const optionOpen = document.createElement("option");
                const optionPaid = document.createElement("option");
                const optionPending = document.createElement("option");
                const optionFailed = document.createElement("option");

                idCol.scope = "row";
                idInput.type = "hidden";
                idInput2.type = "hidden";
                idInput3.type = "hidden";

                idInput.name = "id";
                idInput2.name = "id";
                idInput3.name = "id";

                idInput.value = order.id;
                idInput2.value = order.id;
                idInput3.value = order.id;

                idCol.innerHTML = order.id;
                userIdCol.innerHTML = order.user_id;
                noOfItemsCol.innerHTML = order.no_of_items;
                totalPriceCol.innerHTML = order.total_price;
                statusCol.innerHTML = order.status;
                deleteButton.innerHTML = "Delete";
                editButton.innerHTML = "Edit";
                invoiceButton.innerHTML = "Invoice";

                optionEmpty.value = "";
                optionEmpty.text = "";
                optionOpen.value = "open";
                optionOpen.text = "open";
                optionPaid.value = "paid";
                optionPaid.text = "paid";
                optionPending.value = "pending";
                optionPending.text = "pending";
                optionFailed.value = "failed";
                optionFailed.text = "failed";

                deleteForm.action = '/delete/order';
                deleteForm.method = "POST";
                editForm.action = '/edit/order';
                editForm.method = "POST";
                invoiceForm.method = "POST";
                invoiceForm.action = "/saveInPDF";

                deleteButton.className = "btn btn-danger";
                editButton.className = "btn btn-warning";
                invoiceButton.className = "btn btn-primary";
                changeButton.className = "btn btn-secondary";

                deleteButton.type = "submit";
                editButton.type = "submit";
                invoiceButton.type = "submit";
                changeButton.type = "button";

                deleteForm.appendChild(idInput2);
                deleteForm.appendChild(deleteButton);
                deleteButtonCol.appendChild(deleteForm);

                editForm.appendChild(editButton);
                editForm.appendChild(idInput3);
                editButtonCol.appendChild(editForm);

                invoiceForm.appendChild(invoiceButton);
                invoiceForm.appendChild(idInput);
                invoiceButtonCol.appendChild(invoiceForm);

                changeButton.innerHTML = "Change";
                statusWrapper.appendChild(statusCol);
                statusWrapper.appendChild(changeButton);
                statusWrapper.appendChild(changeDropdown);

                changeButton.addEventListener("click", function() {
                    changeDropdown.style.display = "block";
                });

                statusSelect.addEventListener("change", function() {
                    const newStatus = statusSelect.value;
                    statusCol.innerHTML = newStatus;
                    changeDropdown.style.display = "none";
                    updateOrderStatus(order.id, newStatus);
                });

                statusSelect.appendChild(optionEmpty);
                statusSelect.appendChild(optionOpen);
                statusSelect.appendChild(optionPaid);
                statusSelect.appendChild(optionPending);
                statusSelect.appendChild(optionFailed);

                //shows currently selected status
                // Set the selected attribute for the matching option
                if (order.status === optionOpen.value) {
                    optionOpen.selected = true;
                } else if (order.status === optionPaid.value) {
                    optionPaid.selected = true;
                } else if (order.status === optionPending.value) {
                    optionPending.selected = true;
                } else if (order.status === optionFailed.value) {
                    optionFailed.selected = true;
                }

                changeDropdown.style.display = "none";
                optionEmpty.style.display = "none";
                changeDropdown.appendChild(statusSelect);

                newRow.appendChild(idCol);
                newRow.appendChild(userIdCol);
                newRow.appendChild(noOfItemsCol);
                newRow.appendChild(totalPriceCol);
                newRow.appendChild(statusWrapper);
                newRow.appendChild(deleteButtonCol);
                newRow.appendChild(editButtonCol);
                newRow.appendChild(invoiceButtonCol);

                table.appendChild(newRow);
            }


            loadOrders();

            function updateOrderStatus(orderId, newStatus) {
                const data = { id: orderId, status: newStatus };

                fetch(`http://localhost/api/orders?id=${orderId}`, { // Make a POST request to the API endpoint
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then(result => {
                        console.log('Status update successful:', result);
                    })
                    .catch(error => {
                        console.error('Error updating status:', error);
                    });
            }


            function deleteOrder(id) {
                fetch('http://localhost/api/order/' + id, {
                    method: 'DELETE',
                })
                    .then(result => result.json())
                    .then((orders) => {
                        console.log(orders);
                    })
            }
        </script>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
