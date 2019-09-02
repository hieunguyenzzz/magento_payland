<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Hieu\Payland\Model\Adminhtml\Source;

/**
 * Authorize.net Payment Action Dropdown source
 */
class PaymentAction implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
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
