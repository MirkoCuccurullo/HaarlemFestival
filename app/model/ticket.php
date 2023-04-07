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
    public ?int $vat_id;

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->order_id;
    }

    /**
     * @param int $order_id
     */
    public function setOrderId(int $order_id): void
    {
        $this->order_id = $order_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int|null
     */
    public function getVatId(): ?int
    {
        return $this->vat_id;
    }

    /**
     * @param int|null $vat_id
     */
    public function setVatId(?int $vat_id): void
    {
        $this->vat_id = $vat_id;
    }


}
