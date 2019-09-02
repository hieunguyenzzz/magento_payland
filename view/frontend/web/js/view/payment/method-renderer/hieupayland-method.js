/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/* @api */
define([
    'ko',
    'Magento_Checkout/js/view/payment/default',
    'Magento_Checkout/js/model/url-builder',
    'mage/storage',
    'jquery',
    'mage/cookies'
], function (ko, Component, urlBuilder, storage, $) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Hieu_Payland/payment/payland'
        },

        /**
         * After place order callback
         */
        afterPlaceOrder: function () {
            var serviceUrl;
            serviceUrl = urlBuilder.createUrl('/paylandpaymenturl', {});
            storage.get(
                serviceUrl
            ).fail(function (response) {}
            ).success(function (response) {
                window.location.replace(response);
            });
            this.wait(5000);
        },

        wait: function (ms) {
            var start = new Date().getTime();
            var end = start;
            while(end < start + ms) {
                end = new Date().getTime();
            }
        }
    });
});
