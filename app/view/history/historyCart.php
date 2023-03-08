<?php include __DIR__ . '/../historyHeader.php'; ?>

<!Doctype html>
<html lang="en">
<head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/css/historyCart.css">
        <title>History Event</title>
    </head>
</head>

<br>
<h3 class="heading" id="datendayHeading">Date and Day</h3> </br>

<h3 class="heading" id="timeHeading">Time</h3> </br>
<button id="timeBut">10:00</button>
<button id="timeBut">13:00</button>
<button id="timeBut">16:00</button> </br>

<h3 class="heading" id="languageHeading">Language</h3> </br>
<button id="languageBut">English</button>
<button id="languageBut">Dutch</button>
<button id="languageBut">Chinese</button> </br>

<h3 class="heading" id="noOfTicketsSelectedHeading">Select number of tickets</h3>

<div class="table-wrapper">
    <table>
        <thead>
        <tr>
            <th scope="col">Types</th>
            <th scope="col">Prices</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Single</th>
            <td>€ 17,50</td>
        </tr>
        <tr>
            <th scope="row">Family (4 people)</th>
            <td>€ 60,00</td>
        </tr>
        </tbody>
    </table>

    <table>
        <thead>
        <tr>
            <th scope="col">Number of tickets</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <div class="ticket-box">
                    <button class="minus-btn" type="button" name="button">-</button>
                    <input type="text" name="quantity" value="1">
                    <button class="plus-btn" type="button" name="button">+</button>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="ticket-box">
                    <button class="minus-btn" type="button" name="button">-</button>
                    <input type="text" name="quantity" value="1">
                    <button class="plus-btn" type="button" name="button">+</button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>

    <table>
        <thead>
        <tr>
            <th scope="col">Total</th>
            <th scope="col">Grand Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr>
            <td>0</td>
            <td>0</td>

        </tr>
        </tbody>
    </table>

</div>

<button id="addToCartBut">Add to cart</button>
</body>

</html>


<?php //include __DIR__ . '/../footer.php'; ?>
