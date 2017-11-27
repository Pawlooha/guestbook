<?php
session_start();
require_once ("config.php");//подключение базы данных
$conn = mysqli_connect($hostname, $user, $pass, $db)
or die("Не могу подключиться к базе данных! Причина:".mysqli_error($conn));
mysqli_query($conn, "set names 'utf8'");
function isUserLoggedIn(){
    if(!empty($_SESSION['user'][1])){
        return true;
    }
    else return false;
 }
if (isset ($_POST['add'])){
	$title = strip_tags(trim($_POST['title']));
	$text = strip_tags(trim($_POST['text']));
	$date = $_POST['date'];
	$time = $_POST['time'];
	if (isUserLoggedIn()){
	$user = $_SESSION['user'][1];
	}
	else {
	$anonim = "(Аноним)";
	$user = strip_tags(trim($_POST['user'])).$anonim;	
	}
	mysqli_query ($conn, "
	INSERT INTO autobarachlo(title, user, text, date, time) 
	VALUES('$title', '$user', '$text', '$date', '$time')
	");
	mysqli_close($conn);
	header("Refresh: 1; url=index.php");//переход на главную
	echo "Сообщение успешно добавлено!";
}
$user = $_SESSION['user'][1];
?>
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
<input type="text" name="user" value="<?php echo $user?>"/><br>
<input type="hidden" name="date" value="<?php echo date('Y-m-d')?>"/><br>
<input type="hidden" name="time" value="<?php echo date('H:i')?>"/><br>
<input type="submit" name="add" value= "добавить"/>	
</form>
</body>
</html>