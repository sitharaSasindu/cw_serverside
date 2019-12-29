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

// Backbone View for one contact
var TagEditView = Backbone.View.extend({
	defaults: {
		id: "",
	},
	model: new ContactTag(),
	idAttribute: "id",
	tagName: 'tr',
	initialize: function () {
		this.template = _.template($('.tags-list').html());
	},
	events: {
		'click .edit-tag': 'edit',
		'click .update-tag': 'update',
		'click .cancel': 'cancel',
		'click .delete-tag': 'delete',
	},
	showAdd: function(){
		$('.insert-contact').toggle();
	},
	edit: function () {
		$('.edit-tag').hide();
		$('.delete-tag').hide();
		this.$('.update-tag').show();
		this.$('.cancel').show();

		var tagName = this.$('.tagName').html();

		this.$('.tagName').html('<input type="text" class="form-control tagName-update" value="' + tagName + '">');
	},
	update: function () {
		this.model.set('id', this.$('.tagID').html());
		console.log(this.$('.tagID').html());
		this.model.set('tagName', $('.tagName-update').val());

		this.model.save(null, {
			success: function(response){
				console.log('update success');
			},
			error: function(){
				console.log('fail update');
			}
		});
	},
	cancel: function () {
		tagView.render();
	},
	delete: function () {
		this.model.set('id', this.$('.tagID').html());
		this.model.destroy({
			success: function(response){
				console.log('successful delete');
			},
			error: function(){
				console.log('delete failed');
			}
		});
	},
	render: function () {
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	}
});


// Backbone View for all contacts

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
				_.each(response.toJSON(), function (item) {
					console.log('fetch succesful');
				});
			},
			error: function () {
				console.log('fetch fail');
			}
		});
	},
	render: function () {
		var self = this;
		this.$el.html('');
		_.each(this.model.toArray(), function (tag) {
			self.$el.append((new TagEditView({model: tag})).render().$el);
		});
		return this;
	}
});

var tagView = new tagView();

$(document).ready(function () {
	$('.add-tag').on('click', function () {
		var tag = new ContactTag({
			tagID: 'C' + Math.random().toString(36).substr(2, 9),
			// contactID: $('.contactID-input').val(),
			tagName: $('.tagName-input').val(),
		});
			$('.tagName-input').val(''),
		tags.add(tag);

		tag.save(null, {
			success: function(response) {
				console.log('success insert');
			},
			error: function () {
				console.log('faile insert');
			}
		});
	});
	$('.tagsShow').on('click', function () {
		$('.table-tag').toggle();
	});
});
