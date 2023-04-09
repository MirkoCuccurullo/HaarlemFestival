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
<h3 class="heading" id="timeHeading">Time</h3> <br>
<button id="timeBut"><?php echo $ticketById['time']?></button><br>

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
        var pricePerTicket = 17.50;
        var quantity = document.querySelector('input[name="quantity"]').value;
        var totalPrice = pricePerTicket * quantity;

        document.getElementById('totalPrice').textContent = '€ ' + totalPrice.toFixed(2);
    }

</script>
</body>

</html>

