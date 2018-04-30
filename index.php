<?php
	session_start();
	header('Content-type: text/html; charset=utf-8');

	if(empty($_SESSION)) {
		header("location: /reg-auth.php");
	}

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require_once "handlers/handlerIndex.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>messenger | <?= $_SESSION['name']?></title>
	<link rel="stylesheet" type="text/css" href="/style/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
</head>
<body>
	<div class="col-md-9 col-lg-9 col-sm-12" id="container">
		<div class="row">
			<div id="header-index" class="col-md-12 col-lg-12 col-sm-12">
			<div id="sub-header-index" class="col-md-4 col-lg-4 col-sm-4 col-xl-4">
				<div class="row">
					<div class="col-md-4 col-lg-4 col-sm-4 col-xl-4" id="but">
						<div class="dropdown" >
							<button class="btn" type="button" data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
						     width="15" height="15"
						     viewBox="0 0 50 50"
						     style="fill:#ffffff;"><g id="surface1"><path style=" " d="M 0 7.5 L 0 12.5 L 50 12.5 L 50 7.5 Z M 0 22.5 L 0 27.5 L 50 27.5 L 50 22.5 Z M 0 37.5 L 0 42.5 L 50 42.5 L 50 37.5 Z "></path></g></svg></button>
							<ul class="dropdown-menu">
						 		<li><a href="#">num1</a></li>
						 		<li><a href="#">num2</a></li>
						 		<li><a href="#">num3</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-8 col-lg-8 col-sm-8 col-xl-8">
						<a href="/" id="a-header">My messenger</a>
					</div>
				</div>
			</div>
			<div id="sub-header-index-2" class="col-md-8 col-lg-8 col-sm-8 col-xl-8">
				<div id="user-heder-index" class="col-md-5 col-lg-5 col-sm-5 col-xl-5">
				<span>
					<?php  
						if ($_SESSION['name'] == 'empty') {
							echo $_SESSION['login'];
						}
						else {
							echo $_SESSION['name'];
						}
					?>
					
				</span> <span>Онлайн</span></div>
				<div id="search-header-index" class="col-md-5 col-lg-5 col-sm-5 col-xl-5">
					<input type="text" name="search" placeholder="Поиск" />
				</div>
				<div id="menu-index" class="col-md-2 col-lg-2 col-sm-2 col-xl-2">
					<div class="dropdown" >
						<button class="btn" type="button" data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
					     width="15" height="15"
					     viewBox="0 0 252 252"
					     style="fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,252v-252h252v252z" fill="none"></path><g fill="#ffffff"><g id="surface1"><path d="M152.25,36.75c0,14.7041 -11.5459,26.25 -26.25,26.25c-14.7041,0 -26.25,-11.5459 -26.25,-26.25c0,-14.7041 11.5459,-26.25 26.25,-26.25c14.7041,0 26.25,11.5459 26.25,26.25zM126,99.75c-14.7041,0 -26.25,11.5459 -26.25,26.25c0,14.7041 11.5459,26.25 26.25,26.25c14.7041,0 26.25,-11.5459 26.25,-26.25c0,-14.7041 -11.5459,-26.25 -26.25,-26.25zM126,189c-14.7041,0 -26.25,11.5459 -26.25,26.25c0,14.7041 11.5459,26.25 26.25,26.25c14.7041,0 26.25,-11.5459 26.25,-26.25c0,-14.7041 -11.5459,-26.25 -26.25,-26.25z"></path></g></g></g></svg></button>
						<ul class="dropdown-menu">
					 		<li><a href="#">num1</a></li>
					 		<li><a href="#">num2</a></li>
					 		<li><a href="#"><a href="handlers/exit.php">Выход</a></a></li>
						</ul>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="row">
			<div id="contacts-index" class="col-md-4 col-lg-4 col-sm-4 col-xl-4">
				<div class="row">
					<div id="search-content" class="col-md-12 col-lg-12 col-sm-12 col-xl-12">
						<form name="form-searc-contact" method="POST">
							<input id="serch-c" type="text" name="search-content" placeholder="       Поиск" />
						</form>
					</div>
				</div>
				<div id="contacts-content">
					<?php for($i = 0; $i < count($contact); $i++) : ?>
							<div class="row users">
								<div class="col-md-3 col-lg-3 col-sm-3 col-xl-3">
									<img class="img-contact-user" src="media/image/user/<?= $contact[$i]['image'] ?>" width="50" height="50">
								</div>
								<div class="col-md-9 col-lg-9 col-sm-9 col-xl-9">
									<div class="name-user-contact" value="<?= $contact[$i]['login']?>" ><?= $contact[$i]['name'] ?></div>
									<!-- <div>Тут последнее сообще...</div> -->
								</div>
							</div>
					<?php endfor;?>
				</div>
			</div>
			<div id="message-index" class="col-md-8 col-lg-8 col-sm-8 col-xl-8">
				<div class="message-content">
					<?php if (!empty($messages)) :?>
						<div id="information"></div>
						<?php for ($i = 0; $i < count($messages); $i++) :?>
							<div class="row row-text">
								<div class="col-md-3 col-lg-3 col-sm-3 col-xl-3">
									<div class="img-user-text">
										<img class="img-contact-user" src="media/image/user/<?= $messages[$i][2]['image']?>" width="50" height="50">
									</div>
								</div>
								<div class="col-md-9 col-lg-9 col-sm-9 col-xl-9">
									<div class="text-user">
										<div class="name-user-contact"><?= $messages[$i][0]['name']?></div>
										<div class="text-user-center"><?= $messages[$i][1]['text']?></div>
										<span><?= $messages[$i][4]['time']?></span>
									</div>
								</div>
							</div>
						<?php endfor; ?>
						<!-- <div class="date col-md-12 col-lg-12 col-sm-12 col-xl-12"><---------- за 05.02.2018</div> -->

						<div id="spac"></div>
						<div class="row send-div">
							<form method="POST" id="form-send-message">
								<a href="#"><img class="usr" id="myImg" src="media/image/user/<?= $_SESSION['image']?>" width="50" height="50"></a>
								<textarea id="text-w" name="text"></textarea>
								<a href="#"><img class="usr" id="friendImg" src="media/image/user/1426228433_iv6tzpo0bia.jpg" width="50" height="50"></a>
								<button type="button" class="send-button" name="done">Отправить</button>
							</form>
						</div>
					<?php else: ?>
						
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<script src="scripts/script.js"></script>
</body>
</html>
