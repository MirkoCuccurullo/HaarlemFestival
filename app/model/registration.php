<?php

use Cassandra\Date;

class registration {
    public string $name;
    public string $email;
    public string $password;
    public date $date_of_birth;
    public date $registration_date;

    /**
     * @return Date
     */
    public function getRegistrationDate(): Date
    {
        return $this->registration_date;
    }

    /**
     * @param Date $registration_date
     */
    public function setRegistrationDate(Date $registration_date): void
    {
        $this->registration_date = $registration_date;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return Date
     */
    public function getDateofBirth(): Date
    {
        return $this->date_of_birth;
    }

    /**
     * @param Date $date_of_birth
     */
    public function setDateofBirth(Date $date_of_birth): void
    {
        $this->date_of_birth = $date_of_birth;
    }


}