<?php
	require '../db.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Редактирование задачи</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

<?php

	$id = $_GET['id'];

	$taskEdit = R::getAll('SELECT * FROM `tasks` WHERE `id` = ?', [$id]);
	foreach ($taskEdit as $itemEdit) {

	echo '<form action="editTaskE.php?id='.$itemEdit['id'].'" method="POST">
		<div class="mt-1 form-group">
	    <label for="exampleFormControlInput1">Заголовок задачи</label>
	    <input required name="titleTaskE" type="text" class="form-control" id="exampleFormControlInput1" value="'.$itemEdit["title"].'">
	  </div>
	  <div class="mt-2 form-group">
	    <label for="exampleFormControlTextarea1">Текст задачу</label>
	    <textarea required name="textTaskE" class="form-control" id="exampleFormControlTextarea1" rows="3">'.$itemEdit["text"].'</textarea>
	  </div>
	  <button name="dopostTaskEdit" type="submit" class="btn btn-primary">Изменить</button>
	</form>';

	}
	
?>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>