<?php

	include("/var/www/messenger.loc/model/function.php");
	include("/var/www/messenger.loc/function.php");

	$contact = getContact($_SESSION['id']);

	$contact = explode(',', $contact[0]['contact']);

	$contact = getContactUser($contact);

	$parseToJs = json_encode($contact);



	if (isset($_POST['ajax_for_message'])) {
		$passMessage = '/var/www/messenger.loc/messages/' . $_SESSION['login'] . '_' . $_POST['login'] . '.txt';

		if (!is_file($passMessage)) {
			$passMessage = '/var/www/messenger.loc/messages/' . $_POST['login'] . '_' . $_SESSION['login'] . '.txt';
		}
		if (!is_file($passMessage)) {
			$parseMessage = json_encode("empty");
		    header("Content-type: application/json");
		    print($parseMessage);
		    exit();
		}

		// $messages = fopen($passMessage, "r"); 
		// $a = fread($newMessage, filesize($passMessage));
		$messages = file_get_contents($passMessage);

		$messages = explode(';', $messages);
		for ($i=0; $i < count($messages); $i++) { 
			$messages[$i] = explode(',', $messages[$i]);
			for ($j=0; $j < 5; $j++) { 
				$messages[$i][$j] = explode('-', $messages[$i][$j]);
				$messages[$i][$j] = [$messages[$i][$j][0] => $messages[$i][$j][1]];
			}
		}

		$parseMessage = json_encode($messages);
	    header("Content-type: application/json");
	    print($parseMessage);
	    exit();
	}


	$passMessage = '/var/www/messenger.loc/messages/' . $_SESSION['login'] . '_' . $contact[0]['login'] . '.txt';

	if (!is_file($passMessage)) {
		$passMessage = '/var/www/messenger.loc/messages/' . $contact[0]['login'] . '_' . $_SESSION['login'] . '.txt';
	}

	// $messages = fopen($passMessage, "r"); 
	// $a = fread($newMessage, filesize($passMessage));
	$messages = file_get_contents($passMessage);

	$messages = explode(';', $messages);
	for ($i=0; $i < count($messages); $i++) { 
		$messages[$i] = explode(',', $messages[$i]);
		for ($j=0; $j < 5; $j++) { 
			$messages[$i][$j] = explode('-', $messages[$i][$j]);
			$messages[$i][$j] = [$messages[$i][$j][0] => $messages[$i][$j][1]];
		}
	}

	// var_dump($messages[1][1]);

	// var_dump(date('Y.m.d.H:i:s'));

	if (isset($_POST['done'])) {

		$text = $_POST['text'];

		$text = validStr($text, true);

		$string =	';name-' . $_SESSION['name'] . 
					',text-' . $text . 
					',image-' . $_SESSION['image'] . 
					',date-' . date('Y.m.d') . 
					',time-' . date('H:i:s');

		$newMessage = fopen($passMessage, 'a');
		$writingMessage = fwrite($newMessage, $string);
		fclose($newMessage);
		// var_dump($a);
	}

	if (isset($_POST['search-content'])) {
		$searchQuery = validStr($_POST['search-content']);
		// echo $searchQuery;

		$userSearchContact = findUser($searchQuery);


	}
?>