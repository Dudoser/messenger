<?php
	session_start();
	header('Content-type: text/html; charset=utf-8');
/*	error_reporting(E_ALL);
ini_set('display_errors', 1);*/


?>

<!DOCTYPE html>
<html>
<head>
	<title>Аутентификация</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
	<div id="video-bg">
		<video width="100%" height="auto" preload="auto" autoplay="autoplay" loop="loop" poster="/media/image/bagr.jpg" muted="muted">
			<source src="/media/video/background/Video-background-for-website-Street-Motion-background.mp4" type="video/mp4">
		</video>
	</div>
	<div id="container-reg-auth" class="col-md-12">
	<!-- <div id="message"><h2>Теперь можете войти как пользователь</h2></div> -->
		<?php
			if (isset($_SESSION['success'])) {
				echo "<div id=\"message\"><h2><span id=\"success\">" . $_SESSION['success']  . "</span><br />Теперь можете войти как пользователь</h2></div>";
				unset($_SESSION['success']);
			}
		?>
		<div id="title-auth">
				<?php
					if (isset($_SESSION['error_auth'])) {
						echo "<span id=\"h2\">" . $_SESSION['error_auth'] . "</span>";
						unset($_SESSION['error_auth']);
					}
					else {
						echo "<h2>Авторизация</h2>";
					}
				?>
			</div>
		<div id="title-reg">
			<?php
					if (isset($_SESSION['error_reg'])) {
						echo "<span id=\"h2-reg\">" . $_SESSION['error_reg'] . "</span>";
						unset($_SESSION['error_reg']);
					}
					else {
						echo "<h2>Регистрация</h2>";
					}
				?>
		</div>
		<div id="reg" class="col-md-4">
			<div id="sd"></div>
			<div class="li-form">
				<ul type="none">
					<li>Логин: </li>
					<li>Пароль: </li>
				</ul>
			</div>
			<div class="form-reg-auth">
				<form method="post" action="/handlers/handlerRegAuth.php">
					<input type="text" name="login-auth" />
					<input type="text" name="password-auth" />
					<button type="submit" name="done-auth">Войти</button>
				</form>
			</div>
		</div>

		<div id="auth" class="col-md-4">
			<div class="li-form">
				<ul type="none">
					<li>Логин: </li>
					<li>Пароль: </li>
					<li>E-mail: </li>
				</ul>
			</div>
			<div class="form-reg-auth">
				<form method="post" action="/handlers/handlerRegAuth.php">
					<input type="text" name="login-reg" />
					<input type="text" name="password-reg" />
					<input type="email" name="email-reg" />
					<button type="submit" name="done-reg">Регистрация</button>
				</form>
			</div>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	
</body>
</html>
