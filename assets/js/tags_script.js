// Backbone Model
var ContactTag = Backbone.Model.extend({
	defaults: {
		tagName: '',
	}
});

// Backbone Collection
var contactTags = Backbone.Collection.extend({
	//REST url
	url: 'http://localhost/2016372/cw_serverside/index.php/ContactsAPI/tag/'
});

// instantiate the Collection
var tags = new contactTags();

// Backbone View for single tag
var SingleTagView = Backbone.View.extend({
	defaults: {
		id: "",
	},
	model: new ContactTag(),
	idAttribute: "id", //id attribute add the end of the rest URL
	tagName: 'tr',
	initialize: function () {  //initialize tags script of the tag table
		this.template = _.template($('.tags-list').html());
	},
	events: {  //button events
		'click .edit-tag': 'edit',
		'click .update-tag': 'update',
		'click .cancel': 'cancel',
		'click .delete-tag': 'delete',
	},
	edit: function () { //This will show up the edit text on the particular tag
		$('.edit-tag').hide();
		$('.delete-tag').hide();
		this.$('.update-tag').show();
		this.$('.cancel').show();

		var tagName = this.$('.tagName').html();
		this.$('.tagName').html('<input type="text" class="form-control tagName-update" value="' + tagName + '">');
	},
	update: function () {  //updating the tagName
		this.model.set('id', this.$('.tagID').html());
		this.model.set('tagName', $('.tagName-update').val());

		this.model.save(null, {
			success: function(response){},
			error: function(){}
		});
	},
	cancel: function () {
		tagView.render();
	},
	delete: function () {
		this.model.set('id', this.$('.tagID').html());
		this.model.destroy({
			success: function(response){},
			error: function(){}
		});
	},
	render: function () {
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	}
});


// Backbone View for all tags
var tagView = Backbone.View.extend({
	model: tags,
	el: $('.tag-list'),
	initialize: function () {
		var self = this;
		this.model.on('add', this.render, this);
		this.model.on('change', function () {
			setTimeout(function () {
				self.render();
			}, 30);
		}, this);
		this.model.on('remove', this.render, this);
		this.model.fetch({
			success: function (response) {
				$('.table-tag').hide();
			},
			error: function () {}
		});
	},
	render: function () {
		var self = this;
		this.$el.html('');
		_.each(this.model.toArray(), function (tag) {
			self.$el.append((new SingleTagView({model: tag})).render().$el);
		});
		return this;
	}
});

var tagView = new tagView();

$(document).ready(function () { //Tag add function
	$('.add-tag').on('click', function () {
		var tag = new ContactTag({
			tagID: 'C' + Math.random().toString(36).substr(2, 9),
			tagName: $('.tagName-input').val(),
		});
			$('.tagName-input').val(''), //clear current value on text box
				tags.add(tag);

		tag.save(null, {
			success: function(response) {},
			error: function () {}
		});
	});

	$('.tagsShow').on('click', function () { //show and hide tags table
		$('.table-tag').toggle();
	});
});
