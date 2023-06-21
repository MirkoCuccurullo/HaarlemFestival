<?php

namespace Models;

require_once __DIR__ . '/../model/dance.php';
require_once __DIR__ . '/../model/accessPass.php';
require_once __DIR__ . '/../model/reservation.php';
require_once __DIR__ . '/../service/ticketService.php';
require_once __DIR__ . '/../service/eventService.php';

class vat
{
    public int $id;
    public int $value;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }


}
