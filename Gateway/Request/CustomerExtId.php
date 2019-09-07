<?php
declare(strict_types=1);
namespace Hieu\Payland\Gateway\Request;

use Hieu\Payland\Gateway\Config;
use Magento\AuthorizenetAcceptjs\Gateway\SubjectReader;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;

class CustomerExtId implements BuilderInterface {

    /**
     * @var Config
     */
    private $config;
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @param Config $config
     */
    public function __construct(
        Config $config,
        CustomerRepositoryInterface $customerRepository
    )
    {
        $this->config = $config;
        $this->customerRepository = $customerRepository;
    }

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
        /**
         * @var $gatewayPayment \Magento\Payment\Gateway\Data\PaymentDataObject
         */
        $gatewayPayment = $buildSubject['payment'];
        $customerId = $gatewayPayment->getPayment()->getOrder()->getCustomerId();
        if (empty($customerId)) {
            /**
             * @todo handle guest customer
             */
            return [ 'customer_ext_id' => 'guest' . rand(0,999999)];
        }
        $customer = $this->customerRepository->getById($customerId);
        return [ 'customer_ext_id' => 'user' . $customer->getId()];
    }
}