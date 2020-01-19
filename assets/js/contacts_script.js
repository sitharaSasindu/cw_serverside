// Backbone Model
var userContact = Backbone.Model.extend({
	defaults: {
		ID: "",
		firstName: '',
		surName: '',
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

// Backbone View for one contact
var contactEditView = Backbone.View.extend({
	defaults: {
		id: "",
	},
	model: new userContacts(),
	idAttribute: "id",
	tagName: 'tr',
	initialize: function () { // initializing the template in the html
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
	showAdd: function () { //toggle insert contacts form
		$('.insert-contact').toggle();
	},
	showMore: function () {  //show/ hide extra fields on the contacts screen
		$('.address').toggle();
		$('.email').toggle();
		$('.tb-header-email').toggle();
		$('.tb-header-address').toggle();
		$('.td-address').toggle();
		$('.td-email').toggle();
	},
	edit: function () { //edit button to inject text fields in to html page
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

		var firstName = this.$('.firstName').html();  //getting current values from current model
		var surName = this.$('.surName').html();
		var address = this.$('.address').html();
		var email = this.$('.email').html();
		var phone = this.$('.phone').html();
		var contactTags = this.$('.contactTags').html();

		this.$('.firstName').html('<input type="text" class="form-control firstName-update" value="' + firstName + '" required>');
		this.$('.surName').html('<input type="text" class="form-control surName-update" value="' + surName + '" required>');
		this.$('.address').html('<input type="text" class="form-control address-update" value="' + address + '">');
		this.$('.email').html('<input type="text" class="form-control email-update" value="' + email + '" required>');
		this.$('.phone').html('<input type="text" class="form-control phone-update" value="' + phone + '" required>');
		this.$('.contactTags').html('<select class="selected_tagss" name="selectedGenres[]" multiple="multiple" style="width: 100% ">' +
			'</select>');

		var contactTag = [];
		getTagData(function (tagdata) { //getting data for tag selection drop down menu
			$(".selected_tagss").select2({
				data: tagdata,
				multiple: true,
				placeholder: ''
			});
			tagDataArr = [];

			var tagArr = contactTags.split(', ');
			tagArr.forEach(function (item, index) {  //getting current tags of the model
				tagdata.forEach(function (value, key) {
					if (item == value.text) {
						console.log('mathed')
						contactTag.push(
							value.id
						)
					}
				});
			});
			var $contactSelectedAlready = $(".selected_tagss").select2(); //setting up current tags of the contact
			$contactSelectedAlready.val(contactTag).trigger("change");
		});

	},
	update: function () {
		var selectedTagsArray = ($('.selected_tagss').val())  //getting all the currently selected tags from drop down menu
		var selectedTags = selectedTagsArray.toString();
		var tagsSelect = $('.selected_tagss').select2('data').map(function(elem){
			return elem.text
		});

		this.model.set('id', this.$('.contactID').html());  //setting up the contact id to update
		this.model.set('firstName', $('.firstName-update').val());
		this.model.set('surName', $('.surName-update').val());
		this.model.set('address', $('.address-update').val());
		this.model.set('phone', $('.phone-update').val());
		this.model.set('email', $('.email-update').val());
		this.model.set('tagss', selectedTags);
		this.model.set('contactTags', tagsSelect.toString());

		this.model.save(null, {   //updating current contact on the model
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
		this.model.set('id', this.$('.contactID').html());  //setting contactId to delete
		this.model.destroy({   //deleting the model from the view and database
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
	idAttribute: "id", //id to set the end of the request url
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
		this.model.fetch({ //get all contacts as models
			success: function (response) {
				$('.address').hide(); // hiding extra fields initially
				$('.selected_tags').hide();
				$('.email').hide();
				$('.tb-header-email').hide();
				$('.tb-header-address').hide();
				$('.td-address').hide();
				$('.td-email').hide();
				$('.insert-contact').hide();
				_.each(response.toJSON(), function (item) {
					console.log('fetch Success');
				});
			},
			error: function () {
				document.getElementById("error").style.display = 'block';
				document.getElementById("error").innerHTML = 'No Contacts Found.';
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


var SearchModel  = Backbone.Model.extend({
	defaults: {
		ID: "",
	},
	idAttribute: "ID",
	initialize: function () {
		this.on("invalid", function (model, error) {
		});
	},
	urlRoot: 'http://localhost/2016372/cw_serverside/index.php/ContactsAPI/contact/'
});

$('.searchBtn').on('click', function () {
	var searchTerm = $('.search').val();
	var search  = new SearchModel ({ID: searchTerm});

	_.each(_.clone(contacts.models), function (model) {  //fetching contact search response  view
		model.destroy();
	});

	search .fetch({ //fetching contact search response
		success: function (response) {
			_.each(response.toJSON(), function (item) {
				if(item!= searchTerm) {
					var contact2 = new userContact({
						contactID: item.contactID,
						firstName: item.firstName,
						surName: item.surName,
						address: item.address,
						email: item.email,
						phone: item.phone,
						contactTags: item.contactTags
					});
					contacts.add(contact2);  //add searched results to view
				}
			});
		},
		error: function () {
			document.getElementById("error").style.display = 'block';
			document.getElementById("error").innerHTML = 'No Contacts Found.';
		}
	});
});

var contactView = new ContactView();

$(document).ready(function () {
	$('.add-contact').on('click', function () {  //new contact add function
		var selectedTagsArray = ($('.selected_tags').val());
		var selectedTags = JSON.parse("[" + selectedTagsArray.join() + "]");
		var tagsSelect = $('.selected_tags').select2('data').map(function(elem){
			return elem.text
		});

		var contact = new userContact({
			contactID: 'C' + Math.random().toString(36).substr(2, 9),
			firstName: $('.firstName-input').val(),
			surName: $('.surName-input').val(),
			address: $('.address-input').val(),
			email: $('.email-input').val(),
			phone: $('.phone-input').val(),
			tags: selectedTags,
			contactTags: tagsSelect.toString()
		});
		$('.phone-input').val(''); //clearing text box values in the input fields
		$('.firstName-input').val('');
		$('.surName-input').val('');
		$('.address-input').val('');
		$('.email-input').val('');
		$('.selected_tags').empty();
		contacts.add(contact);
		contact.save(null, {
			success: function (response) {
				console.log('success insert');
			},
			error: function () {
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


