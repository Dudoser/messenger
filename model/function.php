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
		$sql = "INSERT INTO `user` (`id`, `f_name`, `l_name`, `login`, `pass`, `email`, `image`, `about`) VALUES (NULL, 'edf', 'qwd', :login, :pass, :email, 'no-image.jpg', 'wefw');";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		return true;
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