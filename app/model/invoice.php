<?php

class invoice {

    private string $invoiceDate;

    /**
     * @return string
     */
    public function getInvoiceDate(): string
    {
        $this->setInvoiceDate(date('Y-m-d'));
        return $this->invoiceDate;
    }

    /**
     * @param string $invoiceDate
     */
    public function setInvoiceDate(string $invoiceDate): void
    {
        $this->invoiceDate = $invoiceDate;
    }

}
