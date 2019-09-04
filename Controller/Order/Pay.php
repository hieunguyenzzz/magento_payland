<?php

namespace Hieu\Payland\Controller\Order;
class Pay extends \Magento\Framework\App\Action\Action implements \Magento\Framework\App\Action\HttpPostActionInterface
{
    public function execute()
    {
        $params = $this->getRequest()->getParams();
        file_put_contents(BP . '/var/log/paylands.log', print_r($params, true), FILE_APPEND);

        /**
         * @todo update order status here
         */
    }

}