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
        [
            '$scope', '$rootScope', '$compile', '$http', 'pageService',
            function ($scope, $rootScope, $compile, $http, pageService) {

                $scope.page = opsiteconf.page;

                /**
                 * on Drop complete. Update the array of blocks in page and call api to save the change
                 *
                 * @param $index
                 * @param $data
                 * @param $event
                 */
                $scope.onDropComplete = function ($index, $data, $event) {
                    // DO not do anything if block not really moved
                    var currentIndex = $scope.page.blocks.indexOf($data);
                    if (currentIndex === $index) {
                        return;
                    }
                    $scope.page.blocks.splice(currentIndex, 1);
                    $scope.page.blocks.splice($index, 0, $data);
                    pageService.moveBlock($scope.page, $data, $index);
                };

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
            }
        ]
    );

})(window.opsiteconf, angular);
