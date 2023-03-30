<?php


class ticket
{
    public int $id;
    public int $quantity;
    public int $price;
    public ?int $dance_event_id;
    public ?int $yummy_event_id;
    public ?int $history_event_id;
    public ?int $access_pass_id;
    public string $status;
    public int $order_id;
    public int $user_id;
}
