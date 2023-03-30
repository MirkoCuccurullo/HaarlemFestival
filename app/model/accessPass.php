<?php

class accessPass
{
    public int $id;
    public int $price;
    public ?string $date;

    public function displayPass($id)
    {
        if($id == 1)
            $pass = "All-days access pass";
        else
            $pass = "Day-" . ($id-1) . " access pass";

        return $pass;
    }
}