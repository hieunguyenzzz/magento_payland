<?php

namespace Hieu\Payland\Controller\Order;
use Hieu\Payland\Model\Logger;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Model\OrderFactory;
use Magento\Sales\Model\Service\InvoiceService;

class Pay extends \Magento\Framework\App\Action\Action
{
    /**
     * @var InvoiceService
     */
    private $invoiceService;
    /**
     * @var OrderFactory
     */
    private $orderFactory;

    public function __construct(
        Context $context, InvoiceService $invoiceService,
        OrderFactory $orderFactory
    ){
        parent::__construct($context);
        $this->invoiceService = $invoiceService;
        $this->orderFactory = $orderFactory;
    }

    public function execute()
    {
        try {
            $responseData = $this->_getReponseOrderData();
            Logger::debug($responseData);
            $order = $this->orderFactory->create()->load($responseData['order_uuid'], 'payland_order_uuid');
            if (!$order->getId()) {
                throw new LocalizedException(__('Order is not found'));
            }
            $invoice = $this->invoiceService->prepareInvoice($order, []);
            $invoice->setRequestedCaptureCase('online');
            $invoice->register();
            $invoice->getOrder()->setIsInProcess(true);
            $transactionSave = $this->_objectManager->create(
                \Magento\Framework\DB\Transaction::class
            )->addObject(
                $invoice
            )->addObject(
                $invoice->getOrder()
            );
            $transactionSave->save();
        } catch (LocalizedException $e) {
            Logger::error($e->getMessage());
        }

    }

    /**
     * @return array
     * @throws LocalizedException
     */
    protected function _getReponseOrderData() {
        $data = file_get_contents('php://input');
        Logger::debug('-----response data------');
        $data = json_decode($data, true);
        Logger::debug($data);
        if (!isset($data['order'])) {
            throw new LocalizedException(__('Missing order data from payland response'));
        }
        $order = $data['order'];
        $result = [];

        if ($order['transactions']) {
            $transactions = $order['transactions'];
            $transaction = array_pop($transactions);
            $result['txt_id'] = $transaction['uuid'];
        }
        $result['order_uuid'] = $order['uuid'];
        $result['paid'] = $order['paid'];
        $result['order_status'] = $order['status'];

        return $result;
    }

}