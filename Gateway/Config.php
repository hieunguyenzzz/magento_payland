<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Hieu\Payland\Gateway;

use Hieu\Payland\Model\Adminhtml\Source\Environment;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Houses configuration for this gateway
 */
class Config extends \Magento\Payment\Gateway\Config\Config
{
    const METHOD = 'hieu_payland';
    private const KEY_ENVIRONMENT = 'environment';
    private const ENDPOINT_URL_SANDBOX = 'https://apitest.authorize.net/xml/v1/request.api';
    private const ENDPOINT_URL_PRODUCTION = 'https://api.authorize.net/xml/v1/request.api';

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param null|string $methodCode
     * @param string $pathPattern
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        $methodCode = null,
        $pathPattern = self::DEFAULT_PATH_PATTERN
    ) {
        parent::__construct($scopeConfig, $methodCode, $pathPattern);
    }


    /**
     * Gets the API endpoint URL
     *
     * @param int|null $storeId
     * @return string
     */
    public function getApiUrl($storeId = null): string
    {
        $environment = $this->getValue(Config::KEY_ENVIRONMENT, $storeId);

        return $environment === Environment::ENVIRONMENT_SANDBOX
            ? self::ENDPOINT_URL_SANDBOX
            : self::ENDPOINT_URL_PRODUCTION;
    }
}
