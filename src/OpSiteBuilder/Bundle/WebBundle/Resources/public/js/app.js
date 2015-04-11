(function(opsiteconf){
    'use strict';

    var BlockView = Backbone.View.extend({
        tagName: "div",
        className: "document-row",
        events: {
            "click .opsitebuilder-block-edit" : "editClick",
            "click .opsitebuilder-block-edit-cancel": "editCancel",
            "click .opsitebuilder-block-remove": "removeBlock"
        },
        render: function() {
            this.$el.html(this.model.get('template'));
            return this;
        },
        editClick: function() {
            this.model.set('template', "<a class='opsitebuilder-block-edit-cancel'>Cancel</a> <strong>Editing</strong>");
        },
        editCancel: function() {
            this.model.set('template', '<a class="opsitebuilder-block-edit" href="#edit-57">Edit</a><strong>Content for block 57</strong>');
        },
        removeBlock: function() {
            this.remove();
        },
        initialize: function() {
            this.listenTo(this.model, 'change', this.render);
        }
    });

    var blockList = Backbone.Collection.extend({
    });

    var blocks = new blockList(opsiteconf.blocks);

    var AppView = Backbone.View.extend({
        el: $('#test'),
        render: function() {
            this.$el.empty();

            var container = document.createDocumentFragment();
            blocks.each(function(block) {
                var blockView = new BlockView({ model: block });
                container.appendChild(blockView.render().el);
            }, this);

            this.$el.append(container);
        }
    });

    var App = new AppView;
    App.render();

    opsiteconf.toto = {test:"test"};
})(window.opsiteconf);
