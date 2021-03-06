/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

(function(angular, lpfactoryconf){
    'use strict';

    /**
     * Directive lpfactory-tool-add-block
     *
     * Provides basic tool to add block in a page
     */
    angular.module('LpFactoryApp').directive('lpfactoryToolAddBlock', function() {
        return {
            require: '^lpfactoryToolSlidePanel',
            templateUrl: function (tElement, tAttrs) {
                return tAttrs.template;
            },
            link: function (scope, element, attrs, slidePanelCtrl) {
                scope.blocks = lpfactoryconf.configuration.blocks;

                /**
                 * Toggle addBlock tool panel
                 */
                scope.addBlockClick = function () {
                    slidePanelCtrl.toggleSlidePanel('#tool-list');
                };
            }
        };
    });

})(angular, window.lpfactoryconf);
