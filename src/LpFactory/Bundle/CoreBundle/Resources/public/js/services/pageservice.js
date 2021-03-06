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
     * Factory service pageService
     *
     * Make request to page API and returns promises
     * page variable {
     *  'id': id of the page,
     *  'title': title of the page,
     *  'slug': slug of the page
     *  'created': creation date of the page,
     *  'updated': last update date of the page,
     *  'actions': {
     *    'add_block': url for adding a new block,
     *    'move_block': url for moving a block
     *  }
     * }
     */
    angular.module('LpFactoryApp').factory('pageService', ['$http', '$q', function ($http, $q) {

        var BLOCK_ID_PLACEHOLDER = '__BLOCK_ID__';

        /**
         * Add a block to the page
         *
         * @param page
         * @param type
         * @param index
         *
         * @returns Promise
         */
        function addBlock(page, type, index) {
            // TODO : real query
            return $http
                .get(block.actions.view);
        }

        /**
         * Move a block in the page
         *
         * @param page
         * @param block
         * @param index
         *
         * @returns Promise
         */
        function moveBlock(page, block, index) {
            if (!block) {
                return $q.when({});
            }

            // TODO : send position in put query (with block id)
            var url = page.actions.move_block.replace(BLOCK_ID_PLACEHOLDER, block.id)+'?position='+(index+1);
            return $http
                .put(url);
        }

        // page api access
        return {
            addBlock: addBlock,
            moveBlock: moveBlock
        };
    }]);
})(angular);
