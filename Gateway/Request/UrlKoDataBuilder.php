<?php
declare(strict_types=1);
namespace Hieu\Payland\Gateway\Request;

use Hieu\Payland\Gateway\Config;
use Magento\Payment\Gateway\Request\BuilderInterface;

class UrlKoDataBuilder implements BuilderInterface {

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
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function build(array $buildSubject)
    {
        return [ 'url_ko' => $this->config->getUrlKo()];
    }
}