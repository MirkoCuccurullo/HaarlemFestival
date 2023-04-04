<?php

use Decimal\Decimal;

class invoice extends \Models\order {

    public string $clientName; //client name = username
    public int $invoiceNumber; //invoice number = order number
    public string $invoiceDate; //invoice date = order date
    public int $phoneNumber;
    public string $address;
    public string $email;
    public float $subTotalAmount; //per line item
    public float $totalAmount; //total amount = subtotal amount + VAT
    public int $VAT; //VAT = 21% or 9% of subtotal amount
    public string $paymentDate;

    public function __construct($clientName, $invoiceNumber, $invoiceDate, $phoneNumber, $address, $email, $subTotalAmount, $totalAmount, $VAT, $paymentDate)
    {
        $this->clientName = $clientName;
        $this->invoiceNumber = $invoiceNumber;
        $this->invoiceDate = $invoiceDate;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->email = $email;
        $this->subTotalAmount = $subTotalAmount;
        $this->VAT = $VAT;
        $this->paymentDate = $paymentDate;
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return string
     */
    public function getInvoiceDate(): string
    {
        $invoiceDate = $this->invoiceDate;
        if ($invoiceDate !== null) {
            $invoiceDate = date('Y-m-d', strtotime($invoiceDate));
            $this->setInvoiceDate($invoiceDate);
        }
        return $invoiceDate;
    }

    /**
     * @param string $invoiceDate
     */
    public function setInvoiceDate(string $invoiceDate): void
    {
        $invoiceDate = date('Y-m-d', strtotime($invoiceDate));
        $this->invoiceDate = $invoiceDate;
    }



}
