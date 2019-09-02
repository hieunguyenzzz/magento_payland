<?php

namespace Hieu\Payland\Api;

interface PaylandTokenResolverInterface {

    /**
     * @return string`
     */
    public function resolve();
}