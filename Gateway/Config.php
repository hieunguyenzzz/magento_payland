<?php

namespace Hieu\Payland\Gateway;

use Hieu\Payland\Model\Adminhtml\Source\Environment;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Houses configuration for this gateway
 */
class Config extends \Magento\Payment\Gateway\Config\Config
{
    const METHOD = 'hieu_payland';
    const URL_POST = 'paylands/order/pay';
    const URL_OK = 'checkout/onepage/success/';
    /**
     * @todo this should be configurable so it also works with other checkout module i.e onestepcheckout
     */
    const URL_KO = 'checkout/index/index';

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    private $paymentActionMap = ['authorize' => 'AUTHORIZATION'];

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param null|string $methodCode
     * @param string $pathPattern
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        $methodCode = self::METHOD,
        $pathPattern = self::DEFAULT_PATH_PATTERN
    ) {
        parent::__construct($scopeConfig, $methodCode, $pathPattern);
        $this->storeManager = $storeManager;
    }

    /**
     * @return mixed
     */
    public function getPaymentAction() {
        return $this->paymentActionMap[$this->getValue('payment_action')];
    }

    /**
     * @return mixed
     */
    public function getSignature() {
        return $this->getValue('signature');
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getUrlPost() {
        return $this->storeManager->getStore()->getBaseUrl() . self::URL_POST;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getUrlOk() {
        return $this->storeManager->getStore()->getBaseUrl() . self::URL_OK;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getUrlKo() {
        return $this->storeManager->getStore()->getBaseUrl() . self::URL_KO;
    }

    /**
     * @return mixed
     */
    public function getApiKey() {
        return $this->getValue('api_key');
    }

    /**
     * @return mixed
     */
    public function getPaymentService() {
        return $this->getValue('payment_service');
    }

    /**
     *
     *
     * @return string
     */
    public function getAuthorizeApiEndpoint() {
        if ($this->getValue('environment') == \Hieu\Payland\Model\Adminhtml\Source\Environment::ENVIRONMENT_SANDBOX) {
            return 'https://api.paylands.com/v1/sandbox/payment';
        }
        return  'https://api.paylands.com/v1/payment';
    }

    /**
     * @return string
     */
    public function getRedirectApiEndpoint() {
        if ($this->getValue('environment') == \Hieu\Payland\Model\Adminhtml\Source\Environment::ENVIRONMENT_SANDBOX) {
            return 'https://api.paylands.com/v1/sandbox/payment/process/';
        }
        return 'https://api.paylands.com/v1/payment/process/';
    }
}
