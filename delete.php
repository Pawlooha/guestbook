<?php
include_once ("config.php");
$conn = mysqli_connect($hostname, $user, $pass, $db)
or die("Не могу подключиться к базе данных! Причина:".mysqli_error($conn));
mysqli_query($conn, "set names 'utf8'");
$id= $_GET['id'];
mysqli_query($conn, "DELETE FROM autobarachlo WHERE id= '$id'");
mysqli_close($conn);
header("Refresh: 2; url=index.php"); 
echo "Сообщение удалено!";
?>