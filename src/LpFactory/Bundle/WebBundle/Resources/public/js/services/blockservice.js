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
     * Factory service blockService
     *
     * Make request to block API and returns promises
     * block variable {
     *  'id': id of the block,
     *  'title': title of the block,
     *  'sort': position of the block in the page,
     *  'type': Type of the block,
     *  'created': creation date of the block,
     *  'updated': last update date of the block,
     *  'actions': {
     *    'view': url for viewing the block html,
     *    'view_editable': url for viewing the block html with editing tools,
     *    'edit': url for editing the block content,
     *    'remove': url for removing the block
     *  }
     * }
     */
    angular.module('LpFactoryApp').factory('blockService', function ($http) {

        /**
         * Get the block HTML in view mode
         *
         * @param block
         *
         * @returns Promise
         */
        function viewBlock(block) {
            return $http
                .get(block.actions.view);
        }

        /**
         * Get the block HTML in view mode with editing tools
         *
         * @param block
         *
         * @returns Promise
         */
        function viewEditableBlock(block) {
            return $http
                .get(block.actions.view_editable);
        }

        /**
         * Get the block HTML in edit mode
         *
         * @param block
         *
         * @returns Promise
         */
        function editBlock(block) {
            return $http
                .get(block.actions.edit);
        }

        /**
         * Submit the edit form of the block
         *
         * @param block
         * @param formData
         *
         * @returns Promise
         */
        function submitEditBlock(block, formData) {
            return $http
                .post(
                    block.actions.edit,
                    formData,
                    {
                        headers: {
                            "Content-type": "application/x-www-form-urlencoded; charset=utf-8"
                        }
                    }
                );
        }

        /**
         * Remove a block
         *
         * @param block
         *
         * @returns Promise
         */
        function removeBlock(block) {
            return $http
                .delete(block.actions.remove);
        }

        // block api access
        return {
            viewBlock: viewBlock,
            viewEditableBlock: viewEditableBlock,
            editBlock: editBlock,
            submitEditBlock: submitEditBlock,
            removeBlock: removeBlock
        };
    });
})(angular);
