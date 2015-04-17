(function(angular) {
    'use strict';

    angular.module('OpSiteBuilderApp').controller('PageControllerImpl', ['$scope', '$controller', function ($scope, $controller) {
        angular.extend(this, $controller('PageController', {$scope: $scope}));
    }]);

})(angular);
