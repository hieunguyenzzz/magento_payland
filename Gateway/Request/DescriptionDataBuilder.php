<?php
declare(strict_types=1);
namespace Hieu\Payland\Gateway\Request;

use Hieu\Payland\Gateway\Config;
use Magento\Payment\Gateway\Request\BuilderInterface;

class DescriptionDataBuilder implements BuilderInterface {

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
     * @todo identify what is correct value of this request parameter
     *
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject)
    {
        return [ 'description' => 'Purchasing from Magento'];
    }
}