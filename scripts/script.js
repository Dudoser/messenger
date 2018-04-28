$(document).ready(function() {
	$('#message-index').scrollTop(100000);


	/*
	* function for generate div for render messages
	*/
	function divForMessage () {

		var path = 'wef';
		var login = 'dud';
		var name = 'Vlad';
		var text = 'text messages';
		var time = '18:01:41';
		
		var div = document.createElement('div');
		$(div).addClass('row row-text');

		var divChield1 = document.createElement('div');
		$(divChield1).addClass('col-md-3 col-lg-3 col-sm-3 col-xl-3');

		var divImg = document.createElement('div');
		$(divImg).addClass('img-user-text');

		divChield1.appendChild(divImg);
		var img = document.createElement('img');
		$(img).addClass('img-contact-user');
		$(img).attr({
			src: path, 
			width: "50",
			height: "50"
		});
		divImg.appendChild(img);


		var divChield2 = document.createElement('div');
		$(divChield2).addClass('col-md-9 col-lg-9 col-sm-9 col-xl-9');

		var divChield21 = document.createElement('div');
		$(divChield21).addClass('text-user');
		divChield2.appendChild(divChield21);

		var divChield22 = document.createElement('div');
		$(divChield22).addClass('name-user-contact');
		$(divChield22).html(name);

		var divChield23 = document.createElement('div');
		$(divChield23).addClass('text-user-center');
		$(divChield23).html(text);

		var span = document.createElement('span');
		$(span).html(time);

		divChield21.appendChild(divChield22);
		divChield21.appendChild(divChield23);
		divChield21.appendChild(span);

		div.appendChild(divChield1);
		div.appendChild(divChield2);

		return div;
	}

	console.log(divForMessage());

	$(".name-user-contact").bind("click", function (){

		var login = this.getAttribute("value");
		console.log(login);

		$.ajax({
			url: '',
			type: 'post',
			data: {
				login: login,
				ajax_for_message: 1
			},
			success: function (data) {
    			console.log(data);
			},
			error: function (data) {
				console.log("error");
			}
		});
	});



	/*var enc = '<?= $parseToJs ?>';

	var dec = JSON.parse(enc);
	console.log(enc);*/
});

