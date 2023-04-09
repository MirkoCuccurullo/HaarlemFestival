<?php
require_once __DIR__ . '/../../model/order.php';
require_once __DIR__ . '/../../service/bitlyService.php';

include __DIR__ . '/../header.php'; ?>


<div class="row">
    <div class="col mx-auto" style="background-color: #9EBAD9">
        <h1 class="text-center text-black m-3 mb-5">Order summary</h1>

        <div class="row m-5">

            <?php
            if (isset($_SESSION['order'])) {
                $serializedOrder = serialize($_SESSION['order']);
                $jsonOrder = json_encode($serializedOrder);
                $shareLink = 'http://www.localhost/shoppingCart?order=' . urlencode($jsonOrder);

                $bitlyService = new BitlyService();
                $shortLink = $bitlyService->shortenURL($shareLink);
                ?>
                    <div class="container mb-4">
                        <h4>Share your shopping cart with others:</h4>
                <a href="<?php echo $shortLink; ?>"> <?php echo $shortLink ?></a>
                    </div>
                <?php
                $uniqueEvents = $_SESSION['order']->getUniqueEvents();
                foreach ($uniqueEvents as $key => $event) {
                    ?>
                    <div class="col-1 mb-3">
                        <img src="../images/<?php if ($event instanceof accessPass || $event instanceof dance)
                            echo "order-dance-event.svg";
                        else if ($event instanceof reservation)
                            echo "order-yummy-event.svg" ?>" alt="icon" style="width: 50px; height: 50px">
                    </div>

                    <div class="col-6">
                        <h3><?php
                            if ($event instanceof dance)
                                echo $event->artist_name . " @ " . $event->venue_name;
                            else if ($event instanceof accessPass)
                                echo $event->displayPass($event->id);
                            else if ($event instanceof reservation)
                                echo "Reservation @ " . $event->restaurantName . " for " . ($event->numberOfAdults + $event->numberOfUnder12) . " people";
                                echo "Reservation @ " . $event->restaurantName . " for " . ($event->numberOfAdults+ $event->numberOfUnder12) . " people";
                            else if ($event instanceof historyTourTimetable)
                                echo "History tour "
                            ?></h3>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <?php
                            $serializedEvent = serialize($event);
                            $jsonEvent = json_encode($serializedEvent);
                            ?>
                            <div class="col-md-3">
                                <button <?php if ($_SESSION['order']->countForEvent($event) == 1)
                                    echo "disabled";
                                if($event instanceof reservation)
                                    echo " hidden";
                                ?> class="btn btn-primary" id="minus-btn"
                                   onclick="removeEvent(<?= htmlspecialchars($jsonEvent) ?>)">
                                    <strong style="font-size: 1.3em">-</strong>
                                </button>
                            </div>
                            <div class="col-md-3">
                                <h3 id="quantity"
                                    class="ms-2"><?php echo $_SESSION['order']->countForEvent($event) ?></h3>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary" <?php if($event instanceof reservation)
                                    echo "hidden"; ?> onclick="addEvent(<?= htmlspecialchars($jsonEvent) ?>)">
                                    <strong style="font-size: 1.3em">+</strong>
                                </button>
                            </div>
                        </div>
                    </div>

                    <script>
                        function addEvent(event) {
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

                        function shareShoppingCart(order, link){
                            const obj = {order: order};
                            fetch(link , {
                                method: 'POST',
                                headers: {'Content-Type': 'application/json'},
                                body: JSON.stringify(obj),
                            }).then(result => {
                                console.log(result)
                            })
                        }

                    </script>
                    <div class="col-2 text-center">
                        <h3><?php echo "€" . $_SESSION['order']->priceForEvent($event) ?></h3>
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
                <h1><?php if (isset($_SESSION['order']))
                        echo "€" . $_SESSION['order']->total_price;
                    else
                        echo "€0" ?></h1>
            </div>
        </div>

        <form action="/shoppingCart/submit" method="post">
            <div class="row m-3">
                <button class="btn btn-primary fs-3" name="submitOrder">Continue to secure payment</button>
            </div>
        </form>
    </div>
</div>
<?php
include __DIR__ . '/../footer.php'; ?>
