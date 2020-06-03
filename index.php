<?php 
	require 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>ToDoList | Задачник</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body class="container">

	<!--Псевдо шапка :) -->
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">TodoList by Sergey Korobeynikov</h1>
	    <p class="lead">Тестовый проект для компании BeeGee</p>
	  </div>
	</div>

	<!--Меню-->
	<div class="mt-2 dropdown">
	  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Меню
	  </a>

	 <!--Если авторизован-->
	<?php if ( isset ($_SESSION['logged_user']) ) : ?>

			<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
		    <h6 class="dropdown-header">Авторизован!<br/>Привет, <?php echo $_SESSION['logged_user']->login; ?>!<br/></h6>
		    <a class="dropdown-item" href="login/logout.php">Выйти</a>
		  </div>
		</div>

	<!--Форма отправки задачи-->
	<?php
	//Скрипт отправляющий GET параметр последней страницы в пагинации, чтобы после добавления задачи перенести туда пользователя
	$taskCountR = R::count( 'tasks' );

		$pageR = ($taskCountR + 1) / 3;

		echo '<form action="controllTask/actionTasks.php?page='.ceil($pageR).'"  method="POST">';
	?>
	  <div class="mt-1 form-group">
	    <label for="exampleFormControlInput1">Заголовок задачи</label>
	    <input required name="titleTask" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Что-то важное...">
	  </div>
	  <div class="mt-2 form-group">
	    <label for="exampleFormControlTextarea1">Текст задачу</label>
	    <textarea required name="textTask" placeholder="Какой-то текст..." class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
	  </div>
	  <button name="dopostTask" type="submit" class="btn btn-primary">Закрепить задачу</button>
	  <!--Сортировка-->
		<nav class="mt-5 navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="#">Сортировать:</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">

		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		         	По имени пользователя
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="index.php?sort=name&sub-sort=up">По возрастанию</a>
		          <a class="dropdown-item" href="index.php?sort=name&sub-sort=down">По убыванию</a>
		        </div>
		      </li>

		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		         	По статусу
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="index.php?sort=status&sub-sort=up">Выполнено</a>
		          <a class="dropdown-item" href="index.php?sort=status&sub-sort=down">Выполняется</a>
		        </div>
		      </li>

		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		         	По Email
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="index.php?sort=email&sub-sort=up">По возрастанию</a>
		          <a class="dropdown-item" href="index.php?sort=email&sub-sort=down">По убыванию</a>
		        </div>
		      </li>

		    </ul>
		  </div>
		</nav>


	</form>

	<!--Если не авторизован-->
	<?php else : ?>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
	    <h6 class="dropdown-header">Авторизация</h6>
	    <a class="dropdown-item" href="login/login.php">Авторизация</a>
	    <a class="dropdown-item" href="login/signup.php">Регистрация</a>
	  </div>
	</div>

	<div class="mt-5 alert alert-warning" role="alert">
	  Для того чтобы оставлять задачи, <a href="login/login.php">авторизуйтесь</a> или <a href="login/signup.php">зарегистрируйтесь</a>!
	</div>

	<!--Сортировка-->
		<nav class="mt-5 navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="#">Сортировать:</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">

		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		         	По имени пользователя
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="index.php?sort=name&sub-sort=up">По возрастанию</a>
		          <a class="dropdown-item" href="index.php?sort=name&sub-sort=down">По убыванию</a>
		        </div>
		      </li>

		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		         	По статусу
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="index.php?sort=status&sub-sort=up">Выполнено</a>
		          <a class="dropdown-item" href="index.php?sort=status&sub-sort=down">Выполняется</a>
		        </div>
		      </li>

		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		         	По Email
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="index.php?sort=email&sub-sort=up">По возрастанию</a>
		          <a class="dropdown-item" href="index.php?sort=email&sub-sort=down">По убыванию</a>
		        </div>
		      </li>

		    </ul>
		  </div>
		</nav>


	<?php endif; ?>



	<!--Блоки задач и пагинация-->
	<nav aria-label="Page navigation example">
		  <ul class="mt-2 pagination justify-content-center">
		  	<?php
			$taskCount = R::count( 'tasks' );

			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$limit = 3;
			$offset = $limit * ($page - 1);
			$numPagePag = $taskCount / $limit;
			$prev = $page - 1;
			$next = $page + 1;

			//скрипт пагинации, вывод кнопок в зависимости и положения пользователя на определенной странице
			if ( $numPagePag != 0 ){
				if ( $page != 1 ) {
					echo '<li class="page-item"><a class="page-link" href="index.php?page='.$prev.'">Предыдущая</a></li>';
				};
				for ($x=1; $x<=ceil($numPagePag); $x++){

					if ( $x == $page ){
						echo '<li class="page-item active"><a class="page-link" href="index.php?page='.$x.'">'.$x.'</a></li>';
					}else {
						echo '<li class="page-item"><a class="page-link" href="index.php?page='.$x.'">'.$x.'</a></li>';
					}
					
				};
				if ( $page != ceil($numPagePag) ) {
					echo '<li class="page-item"><a class="page-link" href="index.php?page='.$next.'">Следующая</a></li>';
				};
			};

			?>
		  </ul>
		</nav>
		<?php

		if ( $_GET['sort'] == 'name' )
		{
			if ( $_GET['sub-sort'] == 'up' )
			{
				$tasks = R::getAll('SELECT * FROM `tasks` ORDER BY name LIMIT '.$limit.' OFFSET '.$offset);
			}
			if ( $_GET['sub-sort'] == 'down' )
			{
				$tasks = R::getAll('SELECT * FROM `tasks` ORDER BY name DESC LIMIT '.$limit.' OFFSET '.$offset);
			}
		}
		if ( $_GET['sort'] == 'email' )
		{
			if ( $_GET['sub-sort'] == 'up' )
			{
				$tasks = R::getAll('SELECT * FROM `tasks` ORDER BY email LIMIT '.$limit.' OFFSET '.$offset);
			}
			if ( $_GET['sub-sort']=='down' )
			{
				$tasks = R::getAll('SELECT * FROM `tasks` ORDER BY email DESC LIMIT '.$limit.' OFFSET '.$offset);
			}	
		}
		if ( $_GET['sort'] == 'status' )
		{
			if ( $_GET['sub-sort']=='up' )
			{
				$tasks = R::getAll('SELECT * FROM `tasks` ORDER BY status DESC LIMIT '.$limit.' OFFSET '.$offset);
			}
			if ( $_GET['sub-sort']=='down' )
			{
				$tasks = R::getAll('SELECT * FROM `tasks` ORDER BY status LIMIT '.$limit.' OFFSET '.$offset);
			}	
		}
		if ( $_GET['sort'] == NULL )
		{
			$tasks = R::getAll('SELECT * FROM `tasks` LIMIT '.$limit.' OFFSET '.$offset);
		}



		foreach ($tasks as $task)
		{
			if ($_SESSION['logged_user']->login=='admin'){
				echo '<a href="controllTask/editTask.php?id='.$task['id'].'" class="mt-5 badge badge-dark">Редактировать</a>';
			};	
		?>	


			<div class="col mx-auto">
			<div class="col px-md-5 media shadow-lg p-3 mb-5 bg-white rounded">
			  <div class="media-body">
				<h5 class="mt-0"><?php echo $task['title'] ?></h5>
				<p class="text-muted">
				  <?php 
				  //Вывод никнейма и почты пользователя данной задачи
						echo $task['name'] ?> | <?php echo $task['email'];
					?>
				</p>
				<?php


				//Проверка на принадлежание задачи пользователю, для изменения статуса задачи, а также её редактирования
				if ($_SESSION['logged_user']->login!='admin'){

					if ($task['status']==1){echo '<a href="#" class="mt-3 float-right badge badge-success">Готово</a>';}
					else{echo '<a href="#" class="mt-3 float-right badge badge-danger">Не готово</a>';};

				}else{
					if ($task['status']==1){echo '<a href="controllTask/statusChange.php?id='.$task['id'].'&page='.ceil($page).'&status=2" class="mt-3 float-right badge badge-success">Готово</a>';}
					else{echo '<a href="controllTask/statusChange.php?id='.$task['id'].'&page='.ceil($page).'&status=1" class="mt-3 float-right badge badge-danger">Не готово</a>';};
				};
				?>
				
				<div class="dropdown-divider"></div>
			    <p><?php echo $task['text'] ?></p>
			    <?php if ($task['edit'] == 1)
			    {
			    	echo '<br><p style="color:grey">--отредактированно администратором--</p>';
			    }
			    ?>
			  </div>
			 </div>
			</div>
		<?php
		};
		?> 

	<!--boostrap JS-->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>

