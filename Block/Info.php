<?php

declare(strict_types=1);

namespace Hieu\Payland\Block;
use Magento\Framework\Phrase;

class Info extends \Magento\Payment\Block\ConfigurableInfo {
    /**
     * Returns label
     *
     * @param string $field
     * @return Phrase
     * @since 100.3.0
     */
    protected function getLabel($field): Phrase
    {
        return __($field);
    }
}