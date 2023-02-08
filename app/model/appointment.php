<?php


class appointment
{
    public int $id;
    public string $client_name;
    public int $lawyer_id;

    public string $lawyer_name;

    /**
     * @return string
     */
    public function getLawyerName(): string
    {
        return $this->lawyer_name;
    }

    /**
     * @param string $lawyer_name
     */
    public function setLawyerName(string $lawyer_name): void
    {
        $this->lawyer_name = $lawyer_name;
    }

    public int $law_area;
    public string $date;

    public string $time_from;

    public string $time_to;
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
    public function getClientName(): string
    {
        return $this->client_name;
    }

    /**
     * @param string $client_name
     */
    public function setClientName(string $client_name): void
    {
        $this->client_name = $client_name;
    }

    /**
     * @return int
     */
    public function getLawyerId(): int
    {
        return $this->lawyer_id;
    }

    /**
     * @param int $lawyer_id
     */
    public function setLawyerId(int $lawyer_id): void
    {
        $this->lawyer_id = $lawyer_id;
    }

    /**
     * @return int
     */
    public function getLawArea(): int
    {
        return $this->law_area;
    }

    /**
     * @param int $law_area
     */
    public function setLawArea(int $law_area): void
    {
        $this->law_area = $law_area;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTimeFrom(): string
    {
        return $this->time_from;
    }

    /**
     * @param string $time_from
     */
    public function setTimeFrom(string $time_from): void
    {
        $this->time_from = $time_from;
    }

    /**
     * @return string
     */
    public function getTimeTo(): string
    {
        return $this->time_to;
    }

    /**
     * @param string $time_to
     */
    public function setTimeTo(string $time_to): void
    {
        $this->time_to = $time_to;
    }

}