/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

(function(angular, $){
    'use strict';

    /**
     * Directive lpfactory-tool-slide-panel
     *
     * Parent directive for all tool displaying a slide panel
     */
    angular.module('LpFactoryApp').directive('lpfactoryToolSlidePanel', function() {
        return {
            controller: function($scope) {
                this.toggleSlidePanel = function(panelId) {
                    $('.slide-panel:not('+panelId+')').lpSlidePanel('hide');
                    $(panelId).lpSlidePanel('toggle');
                };
            }
        };
    });

})(angular, jQuery);
