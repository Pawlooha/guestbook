<?php
include_once ("config.php");
$conn = mysqli_connect($hostname, $user, $pass, $db)
or die("Не могу подключиться к базе данных! Причина:".mysqli_error($conn));
mysqli_query($conn, "set names 'utf8'");
error_reporting(E_ALL); 
ini_set("display_errors", 1);
	$id = (int) $_GET['id'];   
    $query ="SELECT * FROM autobarachlo WHERE id = '$id'"; 
    $result = mysqli_query($conn, $query); // выполняется запрос 
    $userMessage = mysqli_fetch_assoc($result); // получаем строки
    if (empty($userMessage["id"])) {
		echo "Не удалось найти запись";
		die();
		}
function isUserLoggedIn(){
    if(!empty($_SESSION['user'][1])){
        return true;
    }
    else return false;
 }
    if (isset($_POST['save'])) {     //если кнопка save нажата
    	$anonim = "(Аноним)";
		$title = strip_tags(trim($_POST['title']));
		$text = strip_tags(trim($_POST['text']));
		if (isUserLoggedIn()){
		$user = $_SESSION['user'][1];
		}
		else {
		$user = $userMessage['user'];
		}
		mysqli_query ($conn, "
		UPDATE autobarachlo SET title='$title', user='$user', text='$text' WHERE id = '$id'"); //сохраняется сообщение
	header("Refresh: 1; url=index.php"); //переход на главную
	echo "Сообщение успешно отредактировано!
	сейчас вы перейдёте на главную страницу.";
	mysqli_close($conn);
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Редактирование</title>
</head>
<body>
<form method="POST" action="edit.php?id=<?php echo $id;?>">

Название 
<input type="text" name="title" value="<?php echo $userMessage ['title']; ?>"/><br/>

Текст сообщения<br>
<textarea cols="40" rows="10" name="text"><?php echo $userMessage ['text']; ?></textarea><br>
Автор:<p name="user"><?php echo $userMessage['user'];?><p/><br/>
<input type="submit" name="save" value= "сохранить"/>	
</form>
</body>
</html>