<?php

	include("/var/www/messenger.loc/model/function.php");
	include("/var/www/messenger.loc/function.php");

	$contact = getContact($_SESSION['id']);

	$contact = explode(',', $contact[0]['contact']);

	$contact = getContactUser($contact);

	$parseToJs = json_encode($contact);


	function path () {
		$passMessage = '/var/www/messenger.loc/messages/' . $_SESSION['login'] . '_' . $_POST['login'] . '.txt';

		if (!is_file($passMessage)) {
			$passMessage = '/var/www/messenger.loc/messages/' . $_POST['login'] . '_' . $_SESSION['login'] . '.txt';
		}


		/*if (!is_file($passMessage)) {
			$passMessage = '/var/www/messenger.loc/messages/' . $_SESSION['login'] . '_' . $_POST['login'] . '.txt';
			$string = ';name-' . 'name' . 
						',text-' . 'text' . 
						',image-' . 'image' . 
						',date-' . date('Y.m.d') . 
						',time-' . date('H:i:s');
			$newMessage = fopen($passMessage, 'a');
			$writingMessage = fwrite($newMessage, $string);
			fclose($newMessage);
			chmod($passMessage, 0755);
		}*/

		return $passMessage;
	}

	function getContent($passMessage) {

		$messages = file_get_contents($passMessage);

		$messages = str_replace("\r", '', $messages);
		$messages = str_replace("\n", '', $messages);
		$messages = str_replace(" ", '', $messages);

		/*preg_match("/(\|\|\/>)\n(~`@!~)/g", $messages, $match);
		if (!empty($match)) {
			$messages = preg_replace("/(\|\|\/>)\n(~`@!~)/g", "$1" . '' . "$2", $messages);
			$messages = preg_replace("/(\|\|\/>)\r(~`@!~)/g", "$1" . '' . "$2", $messages);
		}*/
		$messages = explode('~`@!~', $messages);
		for ($i=0; $i < count($messages); $i++) { 
			$messages[$i] = explode('[}~`~/~.~.{]', $messages[$i]);
			for ($j=0; $j < 5; $j++) { 
				$messages[$i][$j] = explode('`{|]"|"[|}~', $messages[$i][$j]);
				$messages[$i][$j] = [$messages[$i][$j][0] => $messages[$i][$j][1]];
			}
		}
		return $messages;
	}


	if (isset($_POST['ajax_for_message'])) {
		// unset($_POST['ajax_for_message']);
		
		$passMessage = path();


		for ($i=0; $i < count($contact); $i++) { 
			if ($contact[$i]['login'] == $_POST['login']) {
				$image = $contact[$i]['image'];
			}
		}

		if (!is_file($passMessage)) {

			$messages = ["empty", $_SESSION['image'], $image];
			$parseMessage = json_encode($messages);
		    header("Content-type: application/json");
		    print($parseMessage);
		    exit();
		}

		$messages = getContent($passMessage);

		$a = [$_SESSION['image'], $image];
		array_push($messages, $a);

		$parseMessage = json_encode($messages);
	    header("Content-type: application/json");
	    print($parseMessage);
	    exit();
	}

	if (isset($_POST['ajaxSendMessage'])) {
			
			$passMessage = path();

			$text = $_POST['text'];

			// die();
			$text = validStr($text, true);

			$string =	'~`@!~name`{|]"|"[|}~' . $_SESSION['name'] . 
						'[}~`~/~.~.{]text`{|]"|"[|}~' . $_POST['text'] . 
						'[}~`~/~.~.{]image`{|]"|"[|}~' . $_SESSION['image'] . 
						'[}~`~/~.~.{]date`{|]"|"[|}~' . date('Y.m.d') . 
						'[}~`~/~.~.{]time`{|]"|"[|}~' . date('H:i:s');

			$newMessage = fopen($passMessage, 'a');
			$writingMessage = fwrite($newMessage, $string);
			fclose($newMessage);

			


			for ($i=0; $i < count($contact); $i++) { 
				if ($contact[$i]['login'] == $_POST['login']) {
					$image = $contact[$i]['image'];
				}
			}

			if (!is_file($passMessage)) {

				$messages = ["empty", $_SESSION['image'], $image];
				$parseMessage = json_encode($messages);
			    header("Content-type: application/json");
			    print($parseMessage);
			    exit();
			}

			$messages = getContent($passMessage);

			$a = [$_SESSION['image'], $image];
			array_push($messages, $a);

			$parseMessage = json_encode($messages);
		    header("Content-type: application/json");
		    print($parseMessage);
		    exit();

		// }
		}



	if (isset($_POST['ajax_for_search'])) {
		$searchQuery = validStr($_POST['search-content']);
		// echo $searchQuery;

		$userSearchContact = findUser($searchQuery);


	}
?>