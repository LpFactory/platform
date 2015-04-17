(function(angular, jQuery){
    'use strict';

    angular.module('OpSiteBuilderApp').directive('opsiteBlock', function($compile, $http) {
        return {
            controller: function ($scope, $element) {
                $scope.loading = false;

                $scope.removeAction = function () {
                    $scope.page.blocks.splice(0,1);
                };

                $scope.editAction = function() {
                    $scope.loading = true;
                    console.log('click on edit in block'+$scope.block.id);
                    $http
                        .get('/block-'+$scope.block.type+'-edit.html')
                        .success(function(html) {
                            $scope.loading = false;
                            $element.html($compile(html)($scope));

                        });
                };

                $scope.simpleSubmit = function(e) {
                    $scope.loading = true;
                    var formData = jQuery(e.target).serialize();
                    $http
                        .post('/block-'+$scope.block.type+'-edit.html', formData, {headers: {"Content-type": "application/x-www-form-urlencoded; charset=utf-8"}})
                        .success(function(html) {
                            $scope.loading = false;
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
                        .get(scope.block.actions.view_block)
                        .success(function(html) {
                            element.html($compile(html)(scope));
                        });
                };
            }
        };
    });

})(angular, jQuery);
