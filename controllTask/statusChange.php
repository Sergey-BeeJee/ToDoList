<?php 
require '../db.php';

if ( $_GET['status']==1 )
{
	$id = $_GET['id'];
	$task = R::load('tasks', $id);
	$task->status = '1';
	R::store($task);
	header('Location: /?page='.$_GET['page']);
}if ( $_GET['status']==2 )
{
	$id = $_GET['id'];
	$task = R::load('tasks', $id);
	$task->status = '0';
	R::store($task);
	header('Location: /?page='.$_GET['page']);
}

?>