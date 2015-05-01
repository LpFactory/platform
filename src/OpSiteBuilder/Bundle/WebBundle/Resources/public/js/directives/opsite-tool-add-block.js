/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

(function(angular, opsiteconf){
    'use strict';

    /**
     * Directive opsite-tool-add-block
     *
     * Provides basic tool to add block in a page
     */
    angular.module('OpSiteBuilderApp').directive('opsiteToolAddBlock', function() {
        return {
            templateUrl: function (tElement, tAttrs) {
                return tAttrs.template;
            },
            link: function (scope, element, attrs) {
                scope.blocks = window.opsiteconf.configuration.blocks;
            }
        };
    });

})(angular, window.opsiteconf);
