<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Мой сайт</title>
</head>
<body>
<a href = "add.php"> Добавить сообщение</a>
<?php
include_once ("db.php");

$result = mysql_query ("SELECT * FROM autobarachlo ORDER BY id DESC LIMIT 10");

mysql_close();
while ($row = mysql_fetch_array($result)) {
echo '<pre>'; 
var_dump($row);
print_r($row); 
echo '</pre>';	
?>

	<h1> <?php echo $row ['title'] . "<br>" ?> </h1>
	<p> <?php echo $row ['text'] . "<br>" ?></p>
	<p> Дата публикации: <?php echo $row ['date'] . "<br>" ?></p>
	<p> Время публикации: <?php echo $row ['time'] . "<br>" ?></p>
	<p> Автор: <?php echo $row ['user'] . "<br>" ?></p>
	<a href = "edit.php?id=<?php echo $row ['id']?>"> Редактировать сообщение</a> 
	<hr>
<?php	
	

};



?>


</body>
</html>