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

    angular.module('OpSiteBuilderApp', ['ngDraggable'])
        .controller('PageEditController', ['$scope', '$rootScope', '$compile', '$http', function ($scope, $rootScope, $compile, $http) {
            $scope.page = page;

            $scope.onDropComplete = function($index,$data,$event) {
                var otherObj = $scope.page.blocks[$index];
                var otherIndex = $scope.page.blocks.indexOf($data);
                $scope.page.blocks[$index] = $data;
                $scope.page.blocks[otherIndex] = otherObj;
            };

            $scope.onDragSuccess = function($data,$event) {
                console.log($data);
                console.log($event);
            }

            $scope.addBlock = function() {
                $http
                    .get('/block-simple-block-edit.html')
                    .success(function(html) {
                        var testBlock = {
                            id: 897,
                            type: "simple-block",
                            name: "block897",
                            template: 'Newly create block: test {{ block.name }}'
                        };
                        $scope.page.blocks.push(testBlock);
                    });
            };
        }])
        .controller('PageEditControllerImp', ['$scope', '$controller', function ($scope, $controller) {
            angular.extend(this, $controller('PageEditController', {$scope: $scope}));

            $scope.customCtrlMethod = function() {
                alert('here');
            };
        }])
        .directive('opsiteSimpleBlock', function($compile, $http) {
            return {
                controller: function ($scope, $element) {
                    $scope.removeAction = function () {
                        $scope.page.blocks.splice(0,1);
                    };
                    $scope.editAction = function() {
                        console.log('click on edit in block'+$scope.block.id);
                        $http
                            .get('/block-'+$scope.block.type+'-edit.html')
                            .success(function(html) {
                                $element.html($compile(html)($scope));
                            });
                    };

                    $scope.cancelAction = function() {
                        console.log('Cancel editing');
                        $http
                            .get('/block-'+$scope.block.type+'.html')
                            .success(function(html) {
                                $element.html($compile(html)($scope));
                            });
                    };

                    $scope.overrideAction = function() {
                        console.log('parent scope');
                    };
                },
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
        })
        .directive('simpleBlock', function() {
            return {
                require: '^opsiteSimpleBlock',
                controller: function ($scope) {
                    $scope.overrideAction = function() {
                        console.log('child scope');
                    };
                }
            };
        });

    angular.element(document).ready(function() {
        angular.bootstrap(document, ['OpSiteBuilderApp']);
    });
})(window.opsiteconf, angular);
