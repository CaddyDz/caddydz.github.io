'use strict';


//Validation forms
function validateForm(selector) {
	Array.from(document.querySelectorAll(selector)).forEach(item => {
		item.addEventListener('input', (e) => {
			if (e.target.value === '') {
				item.dataset.touched = false;
			}
		});
		item.addEventListener('invalid', () => {
			item.dataset.touched = true;
		});
		item.addEventListener('blur', () => {
			if (item.value !== '') item.dataset.touched = true;
		});
	});
};

validateForm('.js-form .form-field');

var form = document.querySelector('.js-form');
var formName = '.js-form';

form.addEventListener('submit', function (e) {
	submitForm(e, formName);
});

function submitForm(e, formName) {
	e.preventDefault();
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var name = $(formName + ' .js-field-name').val();
	var email = $(formName + ' .js-field-email').val();
	var message = $(formName + ' .js-field-message').val();

	var formData = {
		name: name,
		email: email,
		message: message
	};

	$.ajax({
		type: "POST",
		url: '/contact',
		data: formData,
		success: function (response) {
			e.target.reset();
			swal({
				title: response.message,
				text: 'Thank you for reaching out',
				icon: 'success',
				button: 'OK!'
			});
		},
		error: function (response) {
			var data = response.responseJSON;
			swal({
				title: data.message,
				text: data.errors.message[0],
				icon: 'error',
				button: 'Try again'
			});
		}
	});
}
