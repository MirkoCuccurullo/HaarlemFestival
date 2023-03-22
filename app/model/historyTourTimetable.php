<?php

class historyTourTimetable {
    public int $id;
    public string $dateAndDay;
    public string $time;
    public string $language;
    public int $ticketAmount;

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
     * @return string
     */
    public function getDateAndDay(): string
    {
        return $this->dateAndDay;
    }

    /**
     * @param string $dateAndDay
     */
    public function setDateAndDay(string $dateAndDay): void
    {
        $this->dateAndDay = $dateAndDay;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime(string $time): void
    {
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return int
     */
    public function getTicketAmount(): int
    {
        return $this->ticketAmount;
    }

    /**
     * @param int $ticketAmount
     */
    public function setTicketAmount(int $ticketAmount): void
    {
        $this->ticketAmount = $ticketAmount;
    }

}