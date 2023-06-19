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

    public function pay($order, $tickets){
        try {
            $orderId = $order->id;
            $user_id = $order->user_id;


            $payment = $this->mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $order->total_price . ".00",
                ],
                "description" => "Order #{$orderId}",
                //redirect to confirmation page
                "redirectUrl" => "http://localhost/shoppingCart/confirmation?order_id={$orderId}" ,
                //redirect to webhook
                "webhookUrl" => "https://4d26-2a02-a45b-9630-1-97d1-b19b-b460-9156.ngrok-free.app/webhook",
                "method" => \Mollie\Api\Types\PaymentMethod::IDEAL,
                "issuer" => !empty($_POST["issuer"]) ? $_POST["issuer"] : null,
                "metadata" => [
                    //send order id, user id, and tickets to webhook
                    "order_id" => $orderId,
                    "user_id" => $user_id,
                ],
            ]);

            header("Location: " . $payment->getCheckoutUrl(), true, 303);
        }
        catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }

    public function getPayment($payment_id){
        try {
            return $this->mollie->payments->get($payment_id);
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }

}