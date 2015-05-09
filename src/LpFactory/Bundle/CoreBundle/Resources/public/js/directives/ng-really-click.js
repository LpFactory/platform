/**
 * Copyright Asaf Geva
 *
 * @copyright Asaf Geva
 * @link https://gist.github.com/asafge/7430497
 */

(function(angular, window){
    'use strict';

    /**
     * Directive ng-really-click to add confirm box
     *
     * ng-really-message="Are you sure"? ng-really-click="takeAction()"
     * Launch takeAction if user validate in the confirm box
     */
    angular.module('LpFactoryApp').directive('ngReallyClick', function() {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                element.bind('click', function() {
                    var message = attrs.ngReallyMessage;
                    if (message && window.confirm(message)) {
                        scope.$apply(attrs.ngReallyClick);
                    }
                });
            }
        };
    });

})(angular, window);
