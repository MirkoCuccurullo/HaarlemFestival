<?php
require_once __DIR__ . '/../../model/order.php';

include __DIR__ . '/../header.php'; ?>


<div class="row">
    <div class="col mx-auto" style="background-color: #9EBAD9">
        <h1 class="text-center text-black m-3 mb-5">Order summary</h1>

        <div class="row m-5">

            <?php
            //check if order is empty
            if (isset($_SESSION['order']) && empty($_SESSION['order']->getUniqueEvents())) {
                unset($_SESSION['order']);
            }
            if (isset($_SESSION['order'])) {
                //create share link by serializing the order and encoding it in json
                $serializedOrder = serialize($_SESSION['order']);
                $jsonOrder = json_encode($serializedOrder);
                $shareLink = 'http://www.localhost/shoppingCart?order=' . urlencode($jsonOrder);

                //shorten the link using bitly api
                $shortLink = $bitlyService->shortenURL($shareLink);
                ?>
                <div class="container mb-4">
                    <h4>Share your shopping cart with others:</h4>
                    <a href="<?php echo $shortLink; ?>"> <?php echo $shortLink ?></a>
                </div>
            <?php
            //get unique events from order
            $uniqueEvents = $_SESSION['order']->getUniqueEvents();
            foreach ($uniqueEvents

            as $key => $event) {
            ?>
                <div class="col-1 mb-3">
                    <img src="../images/<?php
                    //display event icon
                    if ($event instanceof accessPass || $event instanceof dance)
                        echo "order-dance-event.svg";
                    else if ($event instanceof reservation)
                        echo "order-yummy-event.svg" ?>" alt="icon" style="width: 50px; height: 50px">
                </div>

                <div class="col-6">
                    <h3><?php
                        //display event name
                        if ($event instanceof dance)
                            echo $event->artist_name . " @ " . $event->venue_name;
                        else if ($event instanceof accessPass)
                            echo $event->displayPass($event->id);
                        else if ($event instanceof reservation)
                            echo "Reservation @ " . $event->restaurantName . " for " . ($event->numberOfAdults + $event->numberOfUnder12) . " people";
                        ?></h3>
                </div>

                <div class="col-2">
                    <div class="row">
                        <?php
                        //create json object of the event for remove/add methods
                        $serializedEvent = serialize($event);
                        $jsonEvent = json_encode($serializedEvent);
                        ?>
                        <div class="col-md-3">
                            <button <?php
                            //disable minus button if there is only one event in the order or if the event is a reservation
                            if ($_SESSION['order']->countForEvent($event) == 1)
                                echo "disabled";
                            if ($event instanceof reservation)
                                echo " hidden";
                            ?> class="btn btn-primary" id="minus-btn"
                               onclick="removeEvent(<?= htmlspecialchars($jsonEvent) ?>)">
                                <strong style="font-size: 1.3em">-</strong>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <h3 id="quantity"
                                class="ms-2"><?php
                                //display the count of the event in the order
                                echo $_SESSION['order']->countForEvent($event) ?></h3>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" <?php
                            //disable plus button if the event is a reservation
                            if ($event instanceof reservation)
                                echo "hidden";

                            //disable plus button if the event is a dance and there are no more tickets left
                            if ($event instanceof dance) {
                                $ticketsAboutToBeSold = $_SESSION['order']->countForEvent($event);
                                $ticketsAlreadySold = $event->getSoldTickets();
                                $venue = $event->getVenue();
                                $eventCapacity = $venue->capacity;
                                $ticketsLeft = $eventCapacity - ($ticketsAlreadySold + $ticketsAboutToBeSold);
                                if ($ticketsLeft <= 0)
                                    echo "disabled";
                            }
                            ?> onclick="addEvent(<?= htmlspecialchars($jsonEvent) ?>)">
                                <strong style="font-size: 1.3em">+</strong>
                            </button>
                        </div>
                    </div>
                </div>

                <script>
                    function addEvent(event) {
                        //post request to add event to order
                        const obj = {event: event};
                        fetch('/shoppingCart/quantity?action=add', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/json'},
                            body: JSON.stringify(obj),
                        }).then(result => {
                            window.location.reload();
                            console.log(result)
                        });
                    }

                    function removeEvent(event) {
                        //post request to remove event from order
                        const obj = {event: event};
                        fetch('/shoppingCart/quantity?action=remove', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/json'},
                            body: JSON.stringify(obj),
                        }).then(result => {
                            window.location.reload();
                            console.log(result)
                        });
                    }


                </script>
                <div class="col-2 text-center">
                    <h3><?php
                        //display the price for all events of the same type
                        echo "€" . $_SESSION['order']->priceForEvent($event) ?></h3>
                </div>

                <div class="col-1">
                    <form action="/shoppingCart/remove" method="post">
                        <input hidden type="text" name="remove_item_key" value="<?php echo $key; ?>">
                        <button type="submit" class="btn btn-danger" style="width: 6em">X</button>
                    </form>
                </div>
                <?php
            }
            } else
                echo "No events added yet"; ?>
        </div>


        <div class="row m-3 text-center">
            <div class="col">
                <h1>Total</h1>
            </div>
            <div class="col">
                <h1><?php
                    //display total price of the order
                    if (isset($_SESSION['order']))
                        echo "€" . $_SESSION['order']->total_price;
                    else
                        echo "€0" ?></h1>

            </div>
        </div>

        <form action="/shoppingCart/submit" method="post">
            <div class="row m-3">
                <button <?php
                if(!isset($_SESSION['order']))
                    echo "disabled";
                ?> class="btn btn-primary fs-3" name="submitOrder">Continue to secure payment</button>
            </div>
        </form>
    </div>
</div>
<?php
include __DIR__ . '/../footer.php'; ?>
