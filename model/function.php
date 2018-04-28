<?php

	require_once 'connect_db.php';


	function getUserLogin($login, $email = false) {
		global $pdo;
		if (!empty($email)) {
			$stmt = $pdo->prepare('SELECT * FROM user WHERE login = ? OR email = ?');
    		$stmt->execute([$login, $email]);
		}
		else {
			$stmt = $pdo->prepare('SELECT * FROM user WHERE login = ?');
	    	$stmt->execute([$login]);
		}
    	return $stmt->fetchAll();
	}

	function createUser($login, $pass, $email){
		global $pdo;
		$sql = "INSERT INTO `user` (`id`, `name`, `login`, `pass`, `email`, `image`, `about`) VALUES (NULL, 'empty', :login, :pass, :email, 'no-image.jpg', 'empty');";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		return true;
	}

	function getContact ($id) {
		global $pdo;
		$stmt = $pdo->prepare('SELECT contact FROM user WHERE id = ?');
		$stmt->execute([$id]);
		return $stmt->fetchAll();
	}

	function getContactUser ($arr) {
		global $pdo;
		// $flag = '';

		
		/*for ($i=0; $i < count($arr); $i++) { 
			$flag.= ',?';	
		}*/

		// $flag = substr($flag, 1);
		$flag  = str_repeat('?,', count($arr) - 1) . '?';
		$sql = "SELECT id, login, name, image FROM user WHERE login IN ($flag)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute($arr);

		// die($stmt);

		return $stmt->fetchAll();
	}

	function findUser ($login) {
		global $pdo;
		$sql = "SELECT id, login, name, image FROM user WHERE login = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$login]);

		return $stmt->fetchAll();
	}



/*	function getUserEmail($mail, $login) {
		global $pdo;
		$stmt = $pdo->prepare('SELECT * FROM user WHERE email = ? OR login = ?');
    	$stmt->execute([$mail, $login]);

    // $data = $stmt->fetchAll();
    	return $stmt->fetchAll();
	}
*/

/*
    $stmt = $pdo->prepare('SELECT * FROM user WHERE login = ?');
    $stmt->execute(['dudoser']);

    $data = $stmt->fetchAll();*/

    // var_dump(getUserLogin('dudoser'));
    // var_dump($data);

    // var_dump($stmt);
	/*while ($row = $stmt->fetch(PDO::FETCH_LAZY))
	{
	    echo $row['f_name'] . "\n";
	}*/
?>