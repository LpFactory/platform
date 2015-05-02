/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

(function(lpfactoryconf, angular, $) {
    'use strict';

    function hideDropZone() {
        $('.lpfactory-draw-drop-zone').removeClass('lpfactory-displayed').hide();
    }

    /**
     * Angular controller PageController
     *
     * Base controller for all basic actions on page
     * Extends this controller to provide your custom logic
     */
    angular.module('LpFactoryApp').controller(
        'PageController',
        [
            '$scope', '$rootScope', '$compile', '$http', 'pageService',
            function ($scope, $rootScope, $compile, $http, pageService) {

                $scope.page = lpfactoryconf.page;

                /**
                 * on Drop complete. Update the array of blocks in page and call api to save the change
                 *
                 * @param $index
                 * @param $data
                 * @param $event
                 */
                $scope.onDropComplete = function ($index, $data, $event) {
                    // If data has a onDropComplete method then call it (custom tool action)
                    if (typeof $data.onDropComplete !== "undefined") {
                        $scope[$data.onDropComplete]($data, $index);
                        return;
                    }

                    // DO not do anything if block not really moved
                    var currentIndex = $scope.page.blocks.indexOf($data);
                    if (currentIndex === $index || currentIndex === -1) {
                        return;
                    }
                    // Remove block from position and insert it in new one
                    $scope.page.blocks.splice(currentIndex, 1);
                    $scope.page.blocks.splice($index, 0, $data);
                    hideDropZone();
                    pageService.moveBlock($scope.page, $data, $index);
                };

                /**
                 * Add block to page
                 *
                 * @param $event
                 * @param $index
                 */
                $scope.addBlock = function ($data, $index) {
                    if (typeof lpfactoryconf.page.actions.add_block === undefined) {
                        return;
                    }

                    // Build url to add a block
                    var addBlockUrl = lpfactoryconf.page.actions.add_block.replace('__BLOCK_TYPE__', $data.type);
                    addBlockUrl += '?position=' + $index;
                    $http
                        .post(addBlockUrl)
                        .success(function (newObjectData) {
                            hideDropZone();
                            $scope.page.blocks.splice($index, 0, newObjectData);
                        });
                };

                $rootScope.$on('draggable:end', function () {
                    hideDropZone();
                });

                $scope.onDragMove = function ($data, $event) {
                    // No event hovered, hide all draw drop zone
                    if ($('.drag-enter').length === 0 && !$('.lpfactory-draw-drop-zone').is(':animated')) {
                        hideDropZone();
                    }

                    // Hover an existing block. Display draw drop zone
                    var wrappedResult = $('.drag-enter');
                    // Do not display draw drop zone for dragging element
                    if (wrappedResult.find('.dragging').length) {
                        return;
                    }
                    // Check if dragged element is hover a draw zone
                    var drawDropZone = wrappedResult;
                    if (!wrappedResult.hasClass('.lpfactory-draw-drop-zone')) {
                        drawDropZone = wrappedResult.prev();
                    }
                    // Show right drop zone and hide all other
                    if (!drawDropZone.is(':animated') && !drawDropZone.hasClass('lpfactory-displayed')) {
                        drawDropZone.addClass('lpfactory-displayed').show();
                        drawDropZone.siblings('.lpfactory-draw-drop-zone').not(drawDropZone).removeClass('lpfactory-displayed').hide();
                    }
                };
            }
        ]
    );

})(window.lpfactoryconf, angular, jQuery);
