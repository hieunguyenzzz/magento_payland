<?php
namespace Hieu\Payland\Model\Adminhtml\Source;

/**
 * Authorize.net Payment Action Dropdown source
 */
class PaymentAction implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 'authorize',
                'label' => __('AUTHORIZATION'),
            ],
            [
                'value' => 'deferred',
                'label' => __('DEFERRED')
            ],
            [
                'value' => 'payout',
                'label' => __('PAYOUT')
            ]
        ];
    }
}
