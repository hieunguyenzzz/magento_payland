<?php
namespace Hieu\Payland\Gateway\Request;

use Hieu\Payland\Gateway\Config;
use Magento\Payment\Gateway\Request\BuilderInterface;

class SignatureDataBuilder implements BuilderInterface {

    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Builds ENV request
     *
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject)
    {
        return [ 'signature' => $this->config->getSignature()];
    }
}