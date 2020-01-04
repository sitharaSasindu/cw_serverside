// Backbone Model
var userContact = Backbone.Model.extend({
	defaults: {
		ID: "",
		firstName: '',
		lastName: '',
		address: '',
		email: '',
		phone: ''
	},
});

// Backbone Collection
var userContacts = Backbone.Collection.extend({
	//REST url
	url: 'http://localhost/2016372/cw_serverside/index.php/ContactsAPI/contact/'
});

// instantiate the Collection
var contacts = new userContacts();
var contacts2 = new userContacts();

// Backbone View for one contact
var contactEditView = Backbone.View.extend({
	defaults: {
		id: "",
	},
	model: contacts2,
	idAttribute: "id",
	tagName: 'tr',
	initialize: function () {
		this.template = _.template($('.contacts-list').html());
	},
	events: {
		'click .edit-contact': 'edit',
		'click .update-contact': 'update',
		'click .cancel': 'cancel',
		'click .delete-contact': 'delete',
		'click .moreDetails-contact': 'showMore',
		'click .show': 'showAdd'
	},
	showAdd: function () {
		$('.insert-contact').toggle();
	},
	showMore: function () {
		$('.address').toggle();
		$('.email').toggle();
		$('.tb-header-email').toggle();
		$('.tb-header-address').toggle();
		$('.td-address').toggle();
		$('.td-email').toggle();
	},
	edit: function () {
		$('.edit-contact').hide();
		$('.delete-contact').hide();
		$('.address').show();
		$('.email').show();
		$('.tb-header-email').show();
		$('.tb-header-address').show();
		$('.td-address').show();
		$('.td-email').show();
		this.$('.update-contact').show();
		this.$('.cancel').show();

		var firstName = this.$('.firstName').html();
		var lastName = this.$('.lastName').html();
		var address = this.$('.address').html();
		var email = this.$('.email').html();
		var phone = this.$('.phone').html();
		var contactTags = this.$('.contactTags').html();

		this.$('.firstName').html('<input type="text" class="form-control firstName-update" value="' + firstName + '">');
		this.$('.lastName').html('<input type="text" class="form-control lastName-update" value="' + lastName + '">');
		this.$('.address').html('<input type="text" class="form-control address-update" value="' + address + '">');
		this.$('.email').html('<input type="text" class="form-control email-update" value="' + email + '">');
		this.$('.phone').html('<input type="text" class="form-control phone-update" value="' + phone + '">');
		this.$('.contactTags').html('<select class="selected_tagss" name="selectedGenres[]" multiple="multiple" style="width: 100% ">' +
			'</select>');

		var contactTag = [];
		getTagData(function (tagdata) {
			$(".selected_tagss").select2({
				data: tagdata,
				multiple: true,
				placeholder: ''
			});
			tagDataArr = [];

			var tagArr = contactTags.split(', ');
			tagArr.forEach(function (item, index) {
				tagdata.forEach(function (value, key) {
					if (item == value.text) {
						console.log('mathed')
						contactTag.push(
							value.id
						)


						// console.log(value.id);

					}
				});
			});

			// console.log(contactTag);
			// var arr =

			var $contactSelectedAlready = $(".selected_tagss").select2();
			$contactSelectedAlready.val(contactTag).trigger("change");

		});


		var $select = $('.contactTags');
		var array2 = []
		// getTagData(function (tagdata) {
		//
		// 	var tagArr = contactTags.split(', ');
		// 	tagArr.forEach(function (item, index) {
		// 		tagdata.forEach(function (value, key) {
		// 			if(item == value.text){
		// 				console.log('mathed')
		// 				contactTag.push(
		// 					{id: value.id, text: value.text}
		// 				)
		// 				var $option = $('<option selected></option>').val(value.id).text(value.text);
		// 				$select.append($option).trigger('change');
		//
		// 			} else{
		//
		// 				function add(arr, name) {
		// 					const { length } = arr;
		// 					const id = value.id;
		// 					const found = arr.some(el => el.text === name);
		// 					if (!found) arr.push({ id, text: name });
		// 					return arr;
		// 				}
		//
		// 				add(array2, value.text)
		//
		//
		// 				// array2.push(
		// 				// 	{id: value.id, text: value.text}
		// 				// )
		//
		//
		// 				data_array2= []
		// 			}
		// 		});
		//
		//
		// 	});
		// 	console.log(array2)
		//
		// 	array2.forEach(function (value, key) {
		// 		var $option = $('<option></option>').val(value.id).text(value.text);
		// 		$select.append($option).trigger('change');
		//
		// 	});
		//
		// 	// array2 = []
		// 	$(".contactTags").select2({
		// 		// data: contactTag,
		// 		multiple: true,
		// 		placeholder: ''
		// 	});
		// 	// array2 = []
		//
		//
		//
		// 	tagArr = [];
		// 	contactTag= []
		// 	contactTags =[]
		// 	tagDataArr= []
		// 	data_array2= []
		// });

	},
	update: function () {
		var selectedTagsArray = ($('.selected_tagss').val())
		console.log(selectedTagsArray)

		this.model.set('id', this.$('.contactID').html());
		this.model.set('firstName', $('.firstName-update').val());
		this.model.set('lastName', $('.lastName-update').val());
		this.model.set('address', $('.address-update').val());
		this.model.set('phone', $('.phone-update').val());
		this.model.set('email', $('.email-update').val());
		this.model.set('email', $('.email-update').val());
5
		this.model.save(null, {
			success: function (response) {
				console.log('update success');
			},
			error: function () {
				console.log('fail update');
			}
		});
	},
	cancel: function () {
		contactView.render();
	},
	delete: function () {
		this.model.set('id', this.$('.contactID').html());
		this.model.destroy({
			success: function (response) {
				console.log('successful delete');
			},
			error: function () {
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
var ContactView = Backbone.View.extend({
	model: contacts,
	defaults: {
		id: "",
	},
	idAttribute: "id",
	el: $('.contact-list'),
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
				$('.address').hide();
				$('.selected_tags').hide();
				// $('.td-tags').hide();
				$('.email').hide();
				$('.tb-header-email').hide();
				$('.tb-header-address').hide();
				$('.td-address').hide();
				$('.td-email').hide();
				$('.insert-contact').hide();
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
		_.each(this.model.toArray(), function (contact) {
			self.$el.append((new contactEditView({model: contact})).render().$el);
		});
		return this;
	}
});


var Book = Backbone.Model.extend({
	defaults: {
		ID: "",
	},
	idAttribute: "ID",
	initialize: function () {
		console.log('Book has been initialized');
		this.on("invalid", function (model, error) {
			console.log("Houston, we have a problem: " + error)
		});
	},
	urlRoot: 'http://localhost/2016372/cw_serverside/index.php/ContactsAPI/contact/'
});

$('.searchBtn').on('click', function () {
	var searchTerm = $('.search').val();
	var book1 = new Book({ID: searchTerm});


	console.log(contacts.models);
	_.each(_.clone(contacts.models), function (model) {
		model.destroy();
	});
	// contacts.each(function(model) {
	// 		model.destroy();
	// 	});
	// contacts.models.destroy();
	// _.each(contacts.models, function (item) {
	// 	item.destroy();
	//
	//
	// });

	book1.fetch({
		success: function (response) {
			console.log("Found " + response);
			_.each(response.toJSON(), function (item) {
				var contact2 = new userContact({
					contactID: item.contactID,
					firstName: item.firstName,
					lastName: item.lastName,
					address: item.address,
					email: item.email,
					phone: item.phone,
					contactTags: item.contactTags
				});
				contacts.add(contact2);
				console.log(item);
			});
		}
	});
});


var contactView = new ContactView();

$(document).ready(function () {
	$('.add-contact').on('click', function () {
		var selectedTagsArray = ($('.selected_tags').val());
		var selectedTags = JSON.parse("[" + selectedTagsArray.join() + "]");

		console.log(selectedTags);
		console.log('selectedTagsArray');
		var contact = new userContact({
			contactID: 'C' + Math.random().toString(36).substr(2, 9),
			firstName: $('.firstName-input').val(),
			lastName: $('.lastName-input').val(),
			address: $('.address-input').val(),
			email: $('.email-input').val(),
			phone: $('.phone-input').val(),
			tags: selectedTags
		});
		contacts.add(contact);
		contact.save(null, {
			success: function (response) {
				console.log('success insert');
			},
			error: function () {
				console.log(selectedTags);
				console.log('selectedTagsArray');
				console.log('faile insert');
			}
		});


	});
	$('.show').on('click', function () {
		$('.insert-contact').toggle();
		$('.address').show();
		$('.email').show();
		$('.tb-header-email').show();
		$('.tb-header-address').show();
		$('.td-address').show();
		$('.td-email').show();
	});
});


var tagDataArr = [];


function getTagData(callback) {
	$.ajax({
		method: 'GET',
		url: "http://localhost/2016372/cw_serverside/index.php/ContactsAPI/tag/",
		dataType: 'JSON',
		success: function (data) {
			data.forEach(function (value, key) {
				tagDataArr.push(
					{id: value.tagID, text: value.tagName}
				)
			});
			callback(tagDataArr);
		},
		error: function () {
			console.log("fail")
		}
	});
}


