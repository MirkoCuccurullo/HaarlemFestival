<?php
require_once("law_area.php");
class lawyer
{
    public int $employee_id;
    public string $firstname;
    public string $email;
    public int $area;
    public string $google_token;
    public string $google_refresh_token;

    /**
     * @return int
     */
    public function getEmployeeId(): int
    {
        return $this->employee_id;
    }

    /**
     * @param int $employee_id
     */
    public function setEmployeeId(int $employee_id): void
    {
        $this->employee_id = $employee_id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getArea(): int
    {
        return $this->area;
    }

    /**
     * @param int $area
     */
    public function setArea(int $area): void
    {
        $this->area = $area;
    }



}