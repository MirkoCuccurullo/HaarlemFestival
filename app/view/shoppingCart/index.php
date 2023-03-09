<?php
//require_once __DIR__ . '/../../model/order.php';

include __DIR__ . '/../header.php'; ?>


<form action="shoppingCart" method="post">
    <button type="submit" class="btn-primary fs-4" name="addDanceEvent">Add dance events</button>
</form>

<div class="row">
    <div class="col mx-auto" style="background-color: #9EBAD9">
        <h1 class="text-center text-black m-3 mb-5">Order summary</h1>


        <div class="row m-5">

            <?php
            if (isset($_SESSION['order'])) {
                foreach ($_SESSION['order']->dance_events as $key => $dance_event) {
                    ?>

                    <div class="col-1">
                        <img src="doge.jpg" alt="doge" style="width: 50px; height: 50px">
                    </div>

                    <div class="col-7 text-center">
                        <h3><?php
                            echo $dance_event->artist_name . " @ " . $dance_event->venue_name;
                            ?></h3>
                    </div>

                    <div class="col-3 text-center">
                        <h3><?php echo "€" . $dance_event->price ?></h3>
                    </div>

                    <div class="col-1">
                        <form action="shoppingCart" method="post">
                            <input hidden type="text" name="remove_item_key" value="<?php echo $key; ?>">
                            <button type="submit" class="btn-danger" style="width: 6em">X</button>
                        </form>
                    </div>
                    <?php
                }
            } else
                echo "No events added yet";
            ?>
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

        <form action="shoppingCart" method="post">
            <div class="row m-3">
                <button class="btn-primary fs-3" name="submitOrder">Continue to secure payment</button>
            </div>
        </form>
    </div>
</div>
<?php
include __DIR__ . '/../footer.php'; ?>
