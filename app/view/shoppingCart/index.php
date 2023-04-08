<?php
require_once __DIR__ . '/../../model/order.php';

include __DIR__ . '/../header.php'; ?>


<div class="row">
    <div class="col mx-auto" style="background-color: #9EBAD9">
        <h1 class="text-center text-black m-3 mb-5">Order summary</h1>


        <div class="row m-5">

            <?php
            if (isset($_SESSION['order'])) {
                $uniqueEvents = $_SESSION['order']->getUniqueEvents();
                foreach ($uniqueEvents as $key => $event) {
                    ?>

                    <div class="col-1 mb-3">
                        <img src="../images/order-dance-event.svg" alt="music" style="width: 50px; height: 50px">
                    </div>

                    <div class="col-6">
                        <h3><?php
                            if($event instanceof dance)
                                echo $event->artist_name . " @ " . $event->venue_name;
                            else if ($event instanceof accessPass)
                                echo $event->displayPass($event->id);
                            else if ($event instanceof reservation)
                                echo "Reservation @ " . $event->restaurantName . " for " . ($event->numberOfAdults+ $event->numberOfUnder12) . " people";
                            ?></h3>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <?php
                            $serializedEvent = serialize($event);
                            $jsonEvent = json_encode($serializedEvent);
                            ?>
                            <div class="col-md-3">
                                <button <?php if($_SESSION['order']->countForEvent($event) == 1)
                                    echo "disabled"
                                    ?> class="btn btn-primary" id="minus-btn" onclick="removeEvent(<?= htmlspecialchars($jsonEvent) ?>)">
                                    <strong style="font-size: 1.3em">-</strong>
                                </button>
                            </div>
                            <div class="col-md-3">
                                <h3 id="quantity" class="ms-2"><?php echo $_SESSION['order']->countForEvent($event) ?></h3>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary" onclick="addEvent(<?= htmlspecialchars($jsonEvent) ?>)">
                                    <strong style="font-size: 1.3em">+</strong>
                                </button>
                            </div>
                        </div>
                    </div>

                    <script>
                        function addEvent(event) {
                            const obj = { event: event };
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
                            const obj = { event: event };
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
                }
            else
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
