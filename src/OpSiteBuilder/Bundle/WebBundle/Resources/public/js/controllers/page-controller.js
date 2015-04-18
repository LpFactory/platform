/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/OpSiteBundle/blob/master/LICENSE
 * @link https://github.com/jbouzekri/OpSiteBundle
 */

(function(opsiteconf, angular) {
    'use strict';

    /**
     * Angular controller PageController
     *
     * Base controller for all basic actions on page
     * Extends this controller to provide your custom logic
     */
    angular.module('OpSiteBuilderApp').controller(
        'PageController',
        ['$scope', '$rootScope', '$compile', '$http', function ($scope, $rootScope, $compile, $http) {

        $scope.page = opsiteconf.page;

        $scope.onDropComplete = function ($index, $data, $event) {
            var otherObj = $scope.page.blocks[$index];
            var otherIndex = $scope.page.blocks.indexOf($data);
            $scope.page.blocks[$index] = $data;
            $scope.page.blocks[otherIndex] = otherObj;
        };

        $scope.onDragSuccess = function ($data, $event) {
            console.log($data);
            console.log($event);
        }

        $scope.addBlock = function () {
            $http
                .get('/block-simple-block-edit.html')
                .success(function (html) {
                    var testBlock = {
                        id: 897,
                        type: "simple-block",
                        name: "block897",
                        template: 'Newly create block: test {{ block.name }}'
                    };
                    $scope.page.blocks.push(testBlock);
                });
        };
    }]);

})(window.opsiteconf, angular);
