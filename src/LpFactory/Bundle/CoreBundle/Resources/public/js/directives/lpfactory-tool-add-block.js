/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

(function(angular, lpfactoryconf, $){
    'use strict';

    /**
     * Directive lpfactory-tool-add-block
     *
     * Provides basic tool to add block in a page
     */
    angular.module('LpFactoryApp').directive('lpfactoryToolAddBlock', function() {
        return {
            templateUrl: function (tElement, tAttrs) {
                return tAttrs.template;
            },
            link: function (scope, element, attrs) {
                scope.blocks = lpfactoryconf.configuration.blocks;

                /**
                 * Toggle addBlock tool panel
                 */
                scope.addBlockClick = function () {
                    $('#tool-list').lpSlidePanel('toggle');
                };
            }
        };
    });

})(angular, window.lpfactoryconf, jQuery);
