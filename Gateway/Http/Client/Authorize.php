<?php

namespace Hieu\Payland\Gateway\Http\Client;

use Hieu\Payland\Gateway\Config;
use Hieu\Payland\Gateway\Http\Client;
use Magento\Framework\HTTP\ZendClientFactory;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Payment\Model\Method\Logger as PaymentLogger;
use Psr\Log\LoggerInterface;


class Authorize extends Client
{
    /**
     * @var Config
     */
    private $config;

    public function __construct(
        ZendClientFactory $httpClientFactory,
        PaymentLogger $paymentLogger,
        Json $json,
        LoggerInterface $logger,
        Config $config
    )
    {
        parent::__construct($httpClientFactory, $paymentLogger, $json, $logger);
        $this->config = $config;
    }

    /**
     *
     * @return string
     */
    function getApiUrl()
    {
        return $this->config->getAuthorizeApiEndpoint();
    }
}