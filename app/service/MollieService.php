<?php
require_once __DIR__ . '/../vendor/autoload.php';
class MollieService
{
    private $mollie;
  public function __construct(){

      require('../config.php');
      $this->mollie = new \Mollie\Api\MollieApiClient();
      $this->mollie->setApiKey($Mollie_Key);
  }

  public function pay($order){
      try {
          $method = $this->mollie->methods->get(\Mollie\Api\Types\PaymentMethod::IDEAL, ["include" => "issuers"]);
          $orderId = $order->id;

          $payment = $this->mollie->payments->create([
              "amount" => [
                  "currency" => "EUR",
                  "value" => $order->total_price . ".00",
              ],
              "description" => "Order #{$orderId}",
              //"description" => "Amount to pay for the order",
              "redirectUrl" => "http://localhost/home",
              "webhookUrl" => "https://1d55-31-151-65-113.eu.ngrok.io/we",
              "method" => \Mollie\Api\Types\PaymentMethod::IDEAL,
              "issuer" => !empty($_POST["issuer"]) ? $_POST["issuer"] : null,
              "metadata" => [
                  "order_id" => $orderId,
              ],
              //"issuer"      => "ideal_INGBNL2A", // e.g. "ideal_INGBNbL2A"
          ]);

          //store payment id in the order table

          //$_SESSION['payment_id'] = $payment->id;

          header("Location: " . $payment->getCheckoutUrl(), true, 303);
      }
        catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
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

  public function getPaymentStatus($payment_id){
      $payment_status = null;
      try {
          $payment = $this->mollie->payments->get($payment_id);
          $payment_status = $payment->status;
      }
        catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
        return $payment_status;
  }

}