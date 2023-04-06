<?php
require_once __DIR__ . '/../header.php';
error_reporting(E_ERROR | E_PARSE);
?>

    <div id="alert-box" class="text-center <?php
    if ($status == "paid")
        echo "alert alert-success";
    else
        echo "alert alert-danger";
    ?>" role="alert">
        <h1 id="message" style="color: #000000">
            <?php
            if ($status == "paid")
                echo "Your payment is successful";
            else
                echo "Payment failed";
            ?>
        </h1>
    </div>


<?php
require_once __DIR__ . '/../footer.php';
