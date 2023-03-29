<?php
require_once __DIR__ . '/../header.php';
error_reporting(E_ERROR | E_PARSE);
if($status=="paid")
    echo "<h1>Your payment is successful</h1>";
else
    echo "<h1>Payment failed</h1";

require_once __DIR__ . '/../footer.php';
