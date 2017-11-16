<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Добавить</title>
</head>
<body>

<form method="post" action="add.php">

Название 
<input type="text" name="title"/><br>

Текст сообщения<br>
<textarea cols="40" rows="10" name="text"></textarea><br>

Автор
<input type="text" name="user"/><br>

<input type="hidden" name="date" value="<?php echo date('Y-m-d');?>"/><br>
<input type="hidden" name="time" value="<?php echo date('H-i-s');?>"/><br>
<input type="submit" name="add" value= "добавить"/>	
</form>

<?php

include_once ("db.php");

if (isset ($_POST['add'])) 
{
$title = strip_tags(trim($_POST['title']));
$user = strip_tags(trim($_POST['user']));
$text = strip_tags(trim($_POST['text']));
$date = $_POST['date'];
$time = $_POST['time'];

mysql_query ("
	INSERT INTO autobarachlo(title, user, text, date, time) 
	VALUES('$title', '$user', '$text', '$date', '$time')
	");

mysql_close();
	echo "Сообщение успешно добавлено!";
}
	
?>
</body>
</html>