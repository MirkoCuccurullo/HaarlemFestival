<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';
class MollieService
{
    private $mollie;
  public function __construct(){
      $mollie = new \Mollie\Api\MollieApiClient();
      $mollie->setApiKey($Mollie_Key);
  }

  public function pay($amount){
      $method = $this->mollie->methods->get(\Mollie\Api\Types\PaymentMethod::IDEAL, ["include" => "issuers"]);

      $payment = $this->mollie->payments->create([
          "amount" => [
              "currency" => "EUR",
              "value" => $amount
          ],
          "description" => "Amount to pay for the order",
          "redirectUrl" => "https://localhost/order/payment-success",
          "webhookUrl"  => "https://localhost/order/payment-success",
          "method"      => \Mollie\Api\Types\PaymentMethod::IDEAL,
          "issuer"      => "ideal_INGBNL2A", // e.g. "ideal_INGBNL2A"
      ]);

      //store payment id in the order table

      $_SESSION['payment_id'] = $payment->id;

      header("Location: " . $payment->getCheckoutUrl(), true, 303);
  }

  public function isPaid($payment_id){
      $payment = $this->mollie->payments->get($payment_id);
      if($payment->isPaid()){
          return true;
      }
      return false;
  }

  public function getAllPayments(){
      return $this->mollie->payments->page();
  }

}