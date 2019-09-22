<?php
namespace Hieu\Payland\Gateway\Request;

use Hieu\Payland\Gateway\Config;
use Magento\AuthorizenetAcceptjs\Gateway\SubjectReader;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;

class OrderUUID implements BuilderInterface {

    /**
     * Builds ENV request
     *
     * @param array $buildSubject
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function build(array $buildSubject)
    {

    }
}