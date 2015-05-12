/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

(function(angular, CKEDITOR) {
    'use strict';

    angular.module('LpFactoryApp').directive('lpfactoryCkEditor', [function () {
        return {
            require: '?ngModel',
            link: function ($scope, elm, attr, ngModel) {
                CKEDITOR.replace(elm[0]);

                if (!ngModel) {
                    return;
                }
            }
        };
    }]);
})(angular, CKEDITOR);
