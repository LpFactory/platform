(function(angular){
    'use strict';

    angular.module('OpSiteBuilderApp').directive('textBlock', function() {
        return {
            require: '^opsiteBlock'
        };
    });
})(angular);
