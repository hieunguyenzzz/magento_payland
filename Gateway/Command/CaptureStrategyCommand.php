<?php

namespace Hieu\Payland\Gateway\Command;

use Magento\Payment\Gateway\CommandInterface;

class CaptureStrategyCommand implements CommandInterface {

    /**
     * Executes command basing on business object
     *
     * @param array $commandSubject
     * @return null|\Magento\Payment\Gateway\Command
     * @throws \Magento\Payment\Gateway\Command\CommandException
     */
    public function execute(array $commandSubject)
    {
        // TODO: Implement execute() method.
    }
}