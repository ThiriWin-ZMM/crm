var app = {
    api: "http://localhost/crm/public/api/customers"
};

app.model = Backbone.Model.extend({
    urlRoot: app.api,
    defaults: {
        name: 'unknown',
        email: 'no email',
        phone: 'no phone',
        address: 'no address'
    }
});

app.collection = Backbone.Collection.extend({
    url: app.api,
    model: app.model
});

app.customers = new app.collection();

app.view = Backbone.View.extend({
    tagName: "li",
    className: "list-group-item",
    events: {
        "click .del": "remove"
    },
    template: _.template( $("#template").html() ),
    render: function() {
        var data = this.model.toJSON();
        this.$el.html( this.template(data) );
        return this;
    },
    remove: function() {
        this.model.destroy();
    }
});

app.main = Backbone.View.extend({
    el: 'body',
    events: {
        "click #add": "add"
    },
    initialize: function() {
        this.listenTo(app.customers, 'destroy', this.render);
        this.listenTo(app.customers, 'add', this.render);

        app.customers.fetch({
            success: function(res) {
                res.each(function(model) {
                    var li = new app.view({ model: model });
                    $("#list").append( li.render().el );
                });
            }
        });
    },
    render: function() {
        $("#list").html("");
        app.customers.each(function(model) {
            var li = new app.view({ model: model });
            $("#list").append( li.render().el );
        });
    },
    add: function() {
        var customer = new app.model();
        customer.save({
            name: $("#name").val(),
            email: $("#email").val(),
            phone: $("#phone").val(),
            address: $("#address").val()
        });

        app.customers.add(customer);
        $("#new").modal("hide");
    }
});

$.ajaxSetup({
    headers:{'token':'8XKjolG8zCTWbinRn3QEG6LaKxGZWaRl'}
});

new app.main();