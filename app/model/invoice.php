<?php

class invoice {

    public string $clientName; //client name = username
    public int $invoiceNumber; //invoice number = order number
    public string $invoiceDate; //invoice date = order date
    public int $phoneNumber;
    public string $address;
    public string $email;
    public int $subTotalAmount; //per line item
    public int $totalAmount; //total amount = subtotal amount + VAT
    public int $VAT; //VAT = 21% or 9% of subtotal amount
    public string $paymentDate;

}