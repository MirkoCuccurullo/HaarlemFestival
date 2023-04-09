<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/historyCart.css">
    <title>History Event</title>
</head>

<body>
<br>
<?php if(isset($ticketById))  { ?>
<h3 class="heading" id="datendayHeading"><?php echo $ticketById['dateAndDay']?></h3> <br>
<h3 class="heading" id="timeHeading">Time</h3> </br>
<button id="timeBut"><?php echo $ticketById['time']?></button></br>

<h3 class="heading" id="languageHeading">Language</h3> <br>
<button id="languageBut"><?php echo $ticketById['language']?></button><br>
<h3 class="heading" id="noOfTicketsSelectedHeading">Select number of tickets</h3>
<?php } ?>


<div class="table-wrapper">
    <table>
        <thead>
        <tr>
            <th scope="col">Type</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Single</td>
            <td>€ 17,50</td></tr>
    </table>

    <table>
        <thead>
        <tr>
            <th scope="col">Number of Tickets</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <div class="ticket-box">
                    <button class="minus-btn" id="minus-btn" type="button" name="button">-</button>
                    <input type="text" name="quantity" id="quantity" value="1">
                    <button class="plus-btn" id="plus-btn" type="button" name="button">+</button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>

    <table>
        <thead>
        <tr>
            <th scope="col">Total Price</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td id="totalPrice">€ 17.50</td>
        </tr>

        </tbody>
    </table>
</div>

<form method="post" action="/shoppingCart/add">
    <input type="hidden" name="historyEventId" value="<?php echo $ticketById['id'] ?>">
    <input type="hidden" name="price" value="<?php echo $ticketById['price'] ?>">
    <input type="hidden" name="dateAndDay" value="<?php echo $ticketById['dateAndDay'] ?>">

    <button id="addToCartBut" name="addHistoryEvent">Add to cart</button>
</form>

<script>

    var inputFields = document.querySelectorAll('input[name="quantity"]');
    var increaseBtns = document.querySelectorAll('.ticket-box .plus-btn');
    var decreaseBtns = document.querySelectorAll('.ticket-box .minus-btn');

    inputFields.forEach(function(inputField) {
        if (inputField.value <= 0) {
            inputField.value = 1;
        }
    });

    increaseBtns.forEach(function(increase) {
        increase.addEventListener('click', function() {
            var inputField = this.parentNode.querySelector('input[name="quantity"]');
            inputField.value = parseInt(inputField.value) + 1;

            // Update total price
            updateTotalPrice();
        });
    });

    decreaseBtns.forEach(function(decrease) {
        decrease.addEventListener('click', function() {
            var inputField = this.parentNode.querySelector('input[name="quantity"]');
            if (inputField.value > 1) {
                inputField.value = parseInt(inputField.value) - 1;

                // Update total price
                updateTotalPrice();
            }
        });
    });

    function updateTotalPrice() {
        var pricePerTicket = 17.50; // This should match the price per ticket in the table
        var quantity = document.querySelector('input[name="quantity"]').value;
        var totalPrice = pricePerTicket * quantity;

        document.getElementById('totalPrice').textContent = '€ ' + totalPrice.toFixed(2);
    }

    loadData();
    function loadData() {
        fetch('http://localhost/api/history/historyTourTimetable')
            .then(result => result.json())
            .then((events)=>{
                events.forEach(event => {
                    appendTicketById(event);
                })
            })
    }


    function appendTicketById(ticketById) {
        // Create the necessary HTML elements
        const buttonLanguage = document.createElement("button");
        const divTableWrapper = document.createElement("div");
        const table1 = document.createElement("table");
        const table2 = document.createElement("table");
        const table3 = document.createElement("table");
        const tbody1 = document.createElement("tbody");
        const divTicketBox = document.createElement("div");
        const buttonMinus = document.createElement("button");
        const buttonPlus = document.createElement("button");
        const inputQuantity = document.createElement("input");

        // Set the necessary attributes and text content for each element
        buttonLanguage.setAttribute("id", "languageBut");
        buttonLanguage.textContent = ticketById.language;

        divTableWrapper.setAttribute("class", "table-wrapper");

        table1.innerHTML = `
                    <thead>
                      <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Price</th>
                      </tr>
                    </thead>
                  `;
        tbody1.innerHTML = `
                    <tr>
                      <td>Single</td>
                      <td>€ 17,50</td>
                    </tr>
                  `;
        table1.appendChild(tbody1);

        table2.innerHTML = `
            <thead>
              <tr>
                <th scope="col">Number of Tickets</th>
              </tr>
            </thead>
          `;

        table3.innerHTML = `
            <thead>
              <tr>
                <th scope="col">Total Price</th>
              </tr>
            </thead>
          `;
        divTicketBox.setAttribute("class", "ticket-box");
        buttonMinus.setAttribute("class", "minus-btn");
        buttonMinus.setAttribute("id", "minus-btn");
        buttonMinus.setAttribute("type", "button");
        buttonMinus.setAttribute("name", "button");
        buttonMinus.textContent = "-";
        inputQuantity.setAttribute("type", "text");
        inputQuantity.setAttribute("name", "quantity");
        inputQuantity.setAttribute("id", "quantity");
        inputQuantity.setAttribute("value", "1");
        buttonPlus.setAttribute("class", "plus-btn");
        buttonPlus.setAttribute("id", "plus-btn");
        buttonPlus.setAttribute("type", "button");
        buttonPlus.setAttribute("name", "button");
        buttonPlus.textContent = "+";

        // Append the elements to the DOM
        divTicketBox.appendChild(buttonMinus);
        divTicketBox.appendChild(inputQuantity);
        divTicketBox.appendChild(buttonPlus);
        table2.appendChild(divTicketBox);
        table3.appendChild(tbody1);
        divTableWrapper.appendChild(table1);
        divTableWrapper.appendChild(table2);
        divTableWrapper.appendChild(table3);
        document.getElementById("ticketById").appendChild(buttonLanguage);
        document.getElementById("ticketById").appendChild(divTableWrapper);
        //
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'historyEventId';

        var eventButton = document.createElement('button');
        // eventButton.className = 'btn btn-primary';
        // eventButton.innerHTML = 'Add to cart';
        eventButton.style = 'width: 60%; margin-left: 20%; margin-bottom: 5%;';
        eventButton.type = 'submit';
        eventButton.name = 'addDanceEvent';
    }


</script>
</body>

</html>

