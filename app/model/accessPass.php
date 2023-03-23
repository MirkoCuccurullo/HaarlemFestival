<?php

class accessPass
{
    public int $id;
    public int $price;
    public ?string $date;

    public function displayPass($id)
    {
        if($id == 1)
            echo "All-days access pass";
        else
            echo "Day-" . ($id-1) . " access pass";
    }
}