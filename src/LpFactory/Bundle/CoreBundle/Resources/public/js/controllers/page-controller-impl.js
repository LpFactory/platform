/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

(function(angular) {
    'use strict';

    /**
     * Angular controller PageControllerImpl
     *
     * Main controller for page editing actions
     * Extends PageController
     * Replace it if you want to add custom logic
     */
    angular.module('LpFactoryApp').controller('PageControllerImpl', ['$scope', '$controller', function ($scope, $controller) {
        // Extend the base controller to get all basic action in the scope
        angular.extend(this, $controller('PageController', {$scope: $scope}));
    }]);

})(angular);
