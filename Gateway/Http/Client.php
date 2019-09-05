<?php

namespace Hieu\Payland\Gateway\Http;

use Hieu\Payland\Model\Logger;
use Magento\Framework\HTTP\ZendClient;
use Magento\Framework\HTTP\ZendClientFactory;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Payment\Gateway\Http\ClientException;
use Magento\Payment\Gateway\Http\ClientInterface;
use Magento\Payment\Gateway\Http\TransferInterface;
use Magento\Payment\Model\Method\Logger as PaymentLogger;
use Psr\Log\LoggerInterface;
use InvalidArgumentException;

abstract class Client implements ClientInterface
{

    /**
     * @var ZendClientFactory
     */
    private $httpClientFactory;
    /**
     * @var Json
     */
    private $json;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var PaymentLogger
     */
    private $paymentLogger;

    public function __construct(
        ZendClientFactory $httpClientFactory,
        PaymentLogger $paymentLogger,
        Json $json,
        LoggerInterface $logger
    ){
        $this->httpClientFactory = $httpClientFactory;
        $this->json = $json;
        $this->logger = $logger;
        $this->paymentLogger = $paymentLogger;
    }

    /**
     * Places request to gateway. Returns result as ENV array
     *
     * @param \Magento\Payment\Gateway\Http\TransferInterface $transferObject
     * @return array
     * @throws \Magento\Payment\Gateway\Http\ClientException
     * @throws \Magento\Payment\Gateway\Http\ConverterException
     */
    public function placeRequest(TransferInterface $transferObject)
    {
        $request = $transferObject->getBody();
        $log = [
            'request' => $request,
        ];
        $client = $this->httpClientFactory->create();
        $url = $this->getApiUrl();
        Logger::debug('-----authorize request-----');
        Logger::debug($url);
        try {
            $client->setUri($url);
            $client->setConfig(['maxredirects' => 0, 'timeout' => 30]);
            $client->setRawData($this->json->serialize($request), 'application/json');
            $client->setMethod(ZendClient::POST);
            $client->setAuth($transferObject->getAuthUsername());

            $responseBody = $client->request()
                ->getBody();

            $log['response'] = $responseBody;
            try {
                $data = $this->json->unserialize($responseBody);
            } catch (InvalidArgumentException $e) {
                throw new \Exception('Invalid JSON was returned by the gateway');
            }
            return $data;
        } catch (\Exception $e) {
            Logger::error($e->getMessage());

            throw new ClientException(
                __('Something went wrong in the payment payland.')
            );
        } finally {
            Logger::debug($log);
        }
    }


    abstract function getApiUrl();
}