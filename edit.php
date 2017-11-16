<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Редактирование</title>
</head>
<body>



<?php

include_once ("db.php");
if (isset ($_GET['id'])) 
{
$id = htmlentities(mysqli_real_escape_string($_GET['id']));
     
    // создание строки запроса
    $query ="SELECT * FROM autobarachlo WHERE id = '$id'";
    // выполняем запрос
    $result = mysqli_query($query) or die("Ошибка " . mysqli_error($link)); 
    //если в запросе более нуля строк
    if($result && mysqli_num_rows($result)>0) 
    {
        $row = mysqli_fetch_row($result); // получаем первую строку
        $name = $row[1];
        $company = $row[2];
}
var_dump($_POST);

error_reporting(E_ALL); 
ini_set("display_errors", 1);

$id = (int)' $_GET["id"]';
var_dump($_GET);

$result = mysql_query (" SELECT title, text FROM autobarachlo WHERE id = '$id'");

$flow = mysql_fetch_assoc($result); 


if (isset ($_POST['edit'])) 
{
$title = strip_tags(trim($_POST['title']));
$user = strip_tags(trim($_POST['user']));
$text = strip_tags(trim($_POST['text']));
$date = $_POST['date'];
$time = $_POST['time'];
}
var_dump($_POST);
mysql_close();
	
?>
<form method="get" action="edit.php">

Название 
<input type="text" name="title" value="<?php echo $flow ['title']; ?>"/><br/>

Текст сообщения<br>
<textarea cols="40" rows="10" name="text"><?php echo $flow ['text']; ?></textarea><br/>

Автор
<input type="text" name="user" value="<?php echo $flow['user']; ?>"/><br/>
<input type="submit" name="save" value= "сохранить"/>	
</form>
</body>
</html>