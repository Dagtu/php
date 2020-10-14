<?php
include 'wp-load.php';
if(is_user_logged_in()) {
	header("location: publication.php");
} else {
	if (isset($_POST['send'])) {
		$user = wp_signon();
		if (is_wp_error($user)) {
		} else {
			header("location: publication.php");
				}
 	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Авторизация в системе</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="auth.css">
</head>
<body>

<div id="range4">
        <div class="login-wr">
          <div id="logo"></div>
          <form action="" method="POST">
          <?php
				if (is_wp_error($user)) {
					?>
					<div id="error">
						<?php echo $user->get_error_message(); ?>
					</div>
					<?php
				};
			?>
			 <input type="text" name="log" placeholder="Пользователь">
			 <input type="password" name="pwd" placeholder="Пароль">
			 <p id="remember"><input type="checkbox" name="rememberme" id="rememberme">Запомнить меня</p>
			 <input type="submit" name="send" class="button" value="Вход">
			 </form>     
        </div>
</div>
</body>
</html>