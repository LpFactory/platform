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
    angular.module('LpFactoryApp').directive('lpfactoryToolManagePage', ['$http', function($http) {
        return {
            require: '^lpfactoryToolSlidePanel',
            templateUrl: function (tElement, tAttrs) {
                return tAttrs.template;
            },
            link: function (scope, element, attrs, slidePanelCtrl) {
                scope.treeConfig = {
                    version : 1
                };

                $http.get(lpfactoryconf.page.actions.load_tree).then(function(result) {
                    scope.treeData = result.data;
                    scope.treeConfig.version++;
                });

                /**
                 * Toggle managePage tool panel
                 */
                scope.managePageClick = function () {
                    slidePanelCtrl.toggleSlidePanel('#manage-page');

                };
            }
        };
    }]);

})(angular, window.lpfactoryconf);
