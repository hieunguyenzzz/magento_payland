<?php
namespace Hieu\Payland\Model\Adminhtml\Source;

/**
 * Authorize.net Environment Dropdown source
 */
class Environment implements \Magento\Framework\Data\OptionSourceInterface
{
    const ENVIRONMENT_PRODUCTION = 'production';
    const ENVIRONMENT_SANDBOX = 'sandbox';

    /**
     * Possible environment types
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => self::ENVIRONMENT_SANDBOX,
                'label' => 'Sandbox',
            ],
            [
                'value' => self::ENVIRONMENT_PRODUCTION,
                'label' => 'Production'
            ]
        ];
    }
}
