<?php

	include("/var/www/messenger.loc/model/function.php");

	$contact = getContact($_SESSION['id']);

	$contact = explode(',', $contact[0]['contact']);

	$contact = getContactUser($contact);

	$passMessage = '/var/www/messenger.loc/messages/' . $_SESSION['login'] . '_' . $contact[0]['login'] . '.txt';

	// $messages = fopen($passMessage, "r"); 

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
?>