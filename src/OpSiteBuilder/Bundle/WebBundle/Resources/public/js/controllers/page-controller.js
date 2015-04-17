(function(opsiteconf, angular) {
    'use strict';

    angular.module('OpSiteBuilderApp').controller('PageController', ['$scope', '$rootScope', '$compile', '$http', function ($scope, $rootScope, $compile, $http) {
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
