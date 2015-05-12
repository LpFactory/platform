/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

(function(angular, jQuery, CKEDITOR){
    'use strict';

    /**
     * Directive lpfactory-block
     *
     * Provides all basic block handling action on events
     */
    angular.module('LpFactoryApp').directive('lpfactoryBlock', ['$compile', 'blockService', function($compile, blockService) {
        return {
            controller: function ($scope, $element) {
                $scope.loading = false;

                /**
                 * Remove a block from the page
                 * Launch when clicking on bin link in block
                 */
                $scope.removeAction = function($index) {
                    $scope.loading = true;
                    blockService
                        .removeBlock($scope.block)
                        .success(function(){
                            $scope.loading = false;
                            $scope.page.blocks.splice($index,1);
                        });
                };

                /**
                 * Display the edit form for the block
                 * Launch when clicking on the edit link in the block
                 */
                $scope.editAction = function() {
                    $scope.loading = true;
                    blockService
                        .editBlock($scope.block)
                        .success(function(html) {
                            $scope.loading = false;
                            $element.html($compile(html)($scope));
                        });
                };

                /**
                 * Submit the edit form and display results
                 * @param Element e
                 */
                $scope.simpleSubmit = function(element) {
                    $scope.loading = true;

                    // Manage ckeditor
                    for (var instanceName in CKEDITOR.instances) {
                        CKEDITOR.instances[instanceName].updateElement();
                    }

                    var formData = jQuery(element.target).serialize();
                    blockService
                        .submitEditBlock($scope.block, formData)
                        .success(function(html) {
                            $scope.loading = false;
                            $element.html($compile(html)($scope));
                        });
                };

                /**
                 * Quit the edit view and go back to editable view
                 * Launch when clicking on the cancel link in the edit view of the block
                 */
                $scope.cancelAction = function() {
                    blockService
                        .viewEditableBlock($scope.block)
                        .success(function(html) {
                            $element.html($compile(html)($scope));
                        });
                };
            },
            compile: function(tElement, tAttrs) {
                // Use return function to access scope and have block object
                return function (scope, element, attrs) {
                    // Load the view with actions/edit button for the block
                    blockService
                        .viewEditableBlock(scope.block)
                        .success(function(html) {
                            element.html($compile(html)(scope));
                        });
                };
            }
        };
    }]);

})(angular, jQuery, CKEDITOR);
