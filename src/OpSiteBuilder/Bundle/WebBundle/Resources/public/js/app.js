(function(opsiteconf, angular){
    'use strict';

    var page = {
        id: 1,
        name: "page title toto",
        blocks: [
            {
                id: 123,
                type: "simple-block",
                name: "block1",
                template: 'Name: test {{ block.name }}'
            },
            {
                id: 456,
                type: "simple-block",
                name: "block2",
                template: 'Name: test {{ block.name }}'
            }
        ]
    };

    angular.module('OpSiteBuilderApp', [])
        .controller('PageEditController', ['$scope', '$rootScope', '$compile', function ($scope, $rootScope, $compile) {
            $scope.page = page;
        }])
        .directive('opsiteSimpleBlock', function($compile, $http) {
            return {
                compile: function(tElement, tAttrs) {
                    // Use return function to access scope and have block object
                    return function (scope, element, attrs) {
                        $http
                            .get('/block-'+scope.block.type+'.html')
                            .success(function(html) {
                                element.html($compile(html)(scope));
                            });
                    };
                }
            };
        });

    angular.element(document).ready(function() {
        angular.bootstrap(document, ['OpSiteBuilderApp']);
    });
})(window.opsiteconf, angular);
