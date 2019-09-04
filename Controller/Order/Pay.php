<?php

namespace Hieu\Payland\Controller\Order;
class Pay extends \Magento\Framework\App\Action\Action implements \Magento\Framework\App\Action\HttpPostActionInterface
{
    public function execute()
    {
        $json = file_get_contents('php://input');

// Converts it into a PHP object
        $data = json_decode($json);
        file_put_contents(BP . '/var/log/paylands.log', print_r($data, true), FILE_APPEND);

        /**
         * @todo update order status here
         */
    }

}