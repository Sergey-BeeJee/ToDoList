<?php
require '../db.php';

$title = $_POST['titleTaskE'];
$text = $_POST['textTaskE'];
$id = $_GET['id'];

if (isset($_POST['dopostTaskEdit'])){
	$task = R::load('tasks', $id);
	$task->title = $title;
	$task->text = $text;
	$task->edit = '1';
	R::store($task);
	header('Location: /?id='.$id);
}


?>