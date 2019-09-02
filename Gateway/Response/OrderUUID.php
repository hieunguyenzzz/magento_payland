<?php

declare(strict_types=1);

namespace Hieu\Payland\Gateway\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;

/**
 * Processes transaction id for the payment
 */
class OrderUUID implements HandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handle(array $handlingSubject, array $response): void
    {
        /**
         * @var $gatewayPayment \Magento\Payment\Gateway\Data\PaymentDataObject
         */
        $gatewayPayment = $handlingSubject['payment'];
        $order = $gatewayPayment->getPayment()->getOrder();
        $uuid = $response['order']['uuid'];
        $order->setData('payland_order_uuid', $uuid);
    }
}
