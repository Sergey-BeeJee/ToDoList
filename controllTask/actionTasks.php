<?php
require '../db.php';

		$titleTask = $_POST['titleTask'];
		$textTask = $_POST['textTask'];
		$authorTask = $_SESSION['logged_user'];

		if (isset($_POST['dopostTask'])){
			$tasks = R::dispense('tasks');
			$tasks->title = htmlspecialchars($titleTask);
			$tasks->text = htmlspecialchars($textTask);
			$tasks->name = $authorTask['login'];
			$tasks->email = $authorTask['email'];
			$tasks->status = '0';
			$tasks->edit = '0';
			R::store($tasks);
			header('Location: /?page='.$_GET['page']);

		}

	?>