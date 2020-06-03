<?php 
	require '../db.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Авторизация</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body class="container-fluid">


<?php

	$data = $_POST;
	if ( isset($data['do_login']) )
	{
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if ( $user )
		{
			//логин существует
			if ( password_verify($data['password'], $user->password) )
			{
				//если пароль совпадает, то нужно авторизовать пользователя
				$_SESSION['logged_user'] = $user;
				echo '<div class="alert alert-primary" role="alert">Вы авторизованы!<br/>На <a href="/">главную</a> страницу.</div><hr>';
			}else
			{
				$errors[] = 'Неверно введен пароль!';
			}

		}else
		{
			$errors[] = 'Пользователь с таким логином не найден!';
		}
		
		if ( ! empty($errors) )
		{
			echo '<div id="errors" class="alert alert-danger" role="alert">' .array_shift($errors). '</div>';
		}

	}

?>
	<!--Форма авторизации-->
	<form action="login.php" method="POST">
	  <div class="form-group">
	    <label for="exampleInputEmail1">Логин</label>
	    <input type="text" name="login" value="<?php echo @$data['login']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Пароль</label>
	    <input type="password" name="password" value="<?php echo @$data['password']; ?>" class="form-control" id="exampleInputPassword1">
	  </div>
	  <button type="submit" class="btn btn-primary" name="do_login">Войти</button>
	</form>
	<div class="mb-1 dropdown-divider"></div>
	<a href="/">На главную</a>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>