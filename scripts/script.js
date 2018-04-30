$(document).ready(function() {
	$('#message-index').scrollTop(100000);

	var ob = $('.message-content');

	ob.empty();

	function divForSendMessage (yourImage, friendImage) {

		var path1 = 'media/image/user/' + yourImage;
		var path2 = 'media/image/user/' + friendImage;


		var div = document.createElement('div');
		$(div).addClass('row send-div');

		var form = document.createElement('form');
		$(form).attr({
			method: "post",
			id: "form-send-message"
		});
		var a1 = document.createElement('a');
		$(a1).attr("href", '#');

		var img1 = document.createElement('img');
		$(img1).addClass('usr');
		$(img1).attr({
			src: path1,
			id: "myImg", 
			width: "50",
			height: "50"
		});
		var a2 = document.createElement('a');
		$(a2).attr("href", '#');

		var img2 = document.createElement('img');
		$(img2).addClass('usr');
		$(img2).attr({
			src: path2, 
			width: "50",
			height: "50"
		});

		var textArea = document.createElement('textarea');
		$(textArea).attr({
			id: "text-w",
			name: "text"
		});

		var button = document.createElement('button');
		$(button).attr({
			type: "button",
			name: "done",
			class: "send-button"
		});
		$(button).html('Отправить');

		a1.appendChild(img1);
		a2.appendChild(img2);
		form.appendChild(a1);
		form.appendChild(textArea);
		form.appendChild(a2);
		form.appendChild(button);
		div.appendChild(form);
/*
		$('<div/>').addClass('row send-div').append($('<form/>').attr({method:"post",id:"form-send-message"}))
			.append($('<a/>').attr("href",''));*/


		return div;
	}

	function spac () {
		var div = document.createElement('div');
		$(div).attr("id", 'spac');

		return div
	}

	// console.log(spac());

	/*
	* function for generate div for render messages
	*/
	function divForMessage (data, login) {

		// console.log(data[0][0]['name']);
		// console.log(data[0]);

		// console.log(data);

		// for (var i = 0; i < data.length; i++) {

			var name = data[0]['name'];
			var text = data[1]['text'];
			var path = 'media/image/user/' + data[2]['image'];
			var time = data[4]['time'];
		
		
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
		// }

		// console.log(div);
		return div;
	}

	/*function sendMessage() {
		console.log("123213123131312312");
	}*/

	// console.log(divForMessage());

	function rendsrMessages(login) {
		$.ajax({
			url: '',
			type: 'post',
			data: {
				login: login,
				ajax_for_message: 1
			},
			success: function (data) {

    			// console.log(data);

    			if (data[0] == "empty") {
    				ob.empty();
    				ob.append(spac());
	    			ob.append(divForSendMessage(data[1],data[2]));
    			}
    			else {
    				ob.empty();
	    			for (var i = 0; i < data.length - 1; i++) {
	    				var div = divForMessage(data[i], login);
	    				// console.log(div);
	    				ob.append(div);
	    			}
	    			// console.log(div);
	    			ob.append(spac());
	    			ob.append(divForSendMessage(data[data.length-1][0],data[data.length-1][1]));

					$('#message-index').scrollTop(100000);
    			}
    			
			},
			error: function (data) {
				console.log("error");
			}
		});
		return ob;
	}
	$(".name-user-contact").bind("click", function (){

		var login = this.getAttribute("value");
		// console.log(login);
		ob.html(rendsrMessages(login));
		
	});


	// console.log($('.message-content').html());

	function sec() {
		var areaMessages = $('.message-content').html();
		if (areaMessages == '') {
			console.log("123");
			setTimeout(sec, 1000);
		}
		else {
			console.log("win");	
			$(".send-button").bind("click", function (){

				var text = $('#text-w').val();
				$('#text-w').val('');

				// console.log(text);

				var login = "<?= $_SESSION['login']?>";

				$.ajax({
					url: '',
					type: 'post',
					data: {
						text: text,
						isAjax: 1,
						ajaxSendMessage: 1
					},
					success: function (data) {
						ob.empty();
		    			for (var i = 0; i < data.length - 1; i++) {
		    				var div = divForMessage(data[i], login);
		    				// console.log(div);
		    				ob.append(div);
		    			}
		    			// console.log(div);
		    			ob.append(spac());
		    			ob.append(divForSendMessage(data[data.length-1][0],data[data.length-1][1]));

						$('#message-index').scrollTop(100000);
					},
					error: function (data) {
						console.log("errorSend");
					}
				});
			});
		}
	}
	
	setTimeout(sec, 1000);

	
	  

	



	/*var enc = '<?= $parseToJs ?>';

	var dec = JSON.parse(enc);
	console.log(enc);*/
});

