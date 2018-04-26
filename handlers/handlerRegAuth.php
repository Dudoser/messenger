<?php
	session_start();
	header('Content-type: text/html; charset=utf-8');

/*	error_reporting(E_ALL);
ini_set('display_errors', 1);*/

	
	require_once "../model/function.php";
	require_once "../function.php";
	
	if (isset($_POST['done-auth'])) {


		if (empty($_POST['login-auth'])) {
			$_SESSION['error_auth'] = '<span id="empty">Пустой логин!</span>';
			header("location: ../reg-auth.php");
			exit();
		}
		if (empty($_POST['password-auth'])) {
			$_SESSION['error_auth'] = '<span id="empty">Пустой пароль!</span>';
			header("location: ../reg-auth.php");
			exit();
		}
		else {

			$loginAuth = $_POST['login-auth'];
			$passAuth = $_POST['password-auth'];

			$loginAuth = validStr($loginAuth);
			$passAuth = validStr($passAuth);

			$user = getUserLogin($loginAuth, false);

			if ($user[0]['login'] != $loginAuth) {
				$_SESSION['error_auth'] = "Не правильный логин!";
				header("location: ../reg-auth.php");
			}
			if ($user[0]['pass'] != $passAuth) {
				$_SESSION['error_auth'] = "Не правильный пароль!";
				header("Location:../reg-auth.php");
				
			}
			else {
				$_SESSION['id'] = $user[0]['id'];
				$_SESSION['name'] = $user[0]['name'];
				$_SESSION['login'] = $user[0]['login'];
				$_SESSION['pass'] = $user[0]['pass'];
				$_SESSION['email'] = $user[0]['email'];
				$_SESSION['image'] = $user[0]['image'];
				$_SESSION['about'] = $user[0]['about'];
				header("Location:../index.php");
			}	
		}
	}
	if (isset($_POST['done-reg'])) {
		if (empty($_POST['login-reg'])) {
			$_SESSION['error_reg'] = 'Пустой логин!';
			header("location: ../reg-auth.php");
			exit();
		}
		if (empty($_POST['password-reg'])) {
			$_SESSION['error_reg'] = 'Пустой пароль!';
			header("location: ../reg-auth.php");
			exit();
		}
		if (empty($_POST['email-reg'])) {
			$_SESSION['error_reg'] = 'Пустой E-mail!';
			header("location: ../reg-auth.php");
			exit();
		}
		else {
			$loginReg = $_POST['login-reg'];
			$passReg = $_POST['password-reg'];
			$emailReg = $_POST['email-reg'];

			$loginReg = validStr($loginReg);
			$passReg = validStr($passReg);
			$emailReg = validStr($emailReg);

			$user = getUserLogin($loginReg, $emailReg);

			if ($user[0]['login'] == $loginReg) {
				$_SESSION['error_reg'] = 'Логин занят!';
				header("location: ../reg-auth.php");
			}
			if ($user[0]['email'] == $emailReg) {
				$_SESSION['error_reg'] = 'E-mail занят!';
				header("location: ../reg-auth.php");
			}
			else {
				
				$create = createUser($loginReg, $passReg, $emailReg);
				var_dump($create);
				if ($create) {
					$_SESSION['success'] = "Спасибо за регистрацию!";
					header("location: ../reg-auth.php");

				}
				else {
					$_SESSION['error_reg'] = 'что-то как-то не получилось зарегистрироваться.. =( обязательно нужно попробовать еще разок ;) <a href="http://messenger.loc/reg-auth.php/">еще разок ;)</a>';
					header("location: ../error.php");
				}
			}
		}
	}

?>