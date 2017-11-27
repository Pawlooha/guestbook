<?php
session_start();
//подключение к базе
$conn = mysqli_connect($hostname, $user, $pass, $db)
or die("Не могу подключиться к базе данных! Причина:".mysqli_error($conn));
mysqli_query($conn, "set names 'utf8'");
//права доступа
$type = $_SESSION['user'][2];
switch ($type) {
        case 'admin':
        $hidden1 = "edit";
        $hidden2 = "delete";
            echo "ОПА";
            break;
        case 'user':
        $hidden1 = "hidden";
        $hidden2 = "hidden";
            echo "ОП ОП";
            break;
        default:
        $hidden1 = "hidden";
        $hidden2 = "hidden";
        echo "ОПа ОПа";
}
//постраничная навигация
$page = $_GET['page'];
$result00 = mysqli_query($conn, "SELECT COUNT(*) FROM autobarachlo");
$temp = mysqli_fetch_array($result00);
$posts = $temp[0];
$total = (($posts - 1) / $num) + 1;
$total =  intval($total);
$page = intval($page);
if(empty($page) or $page < 0) $page = 1;
if($page > $total) $page = $total;
$start = $page * $num - $num;
// Проверяем нужны ли стрелки назад
if ($page != 1) $pervpage = '<a href=index.php?page=1>Первая</a> | <a href=index.php?page='. ($page - 1) .'>Предыдущая</a> | ';
// Проверяем нужны ли стрелки вперед
if ($page != $total) $nextpage = ' | <a href=index.php?page='. ($page + 1) .'>Следующая</a> | <a href=index.php?page=' .$total. '>Последняя</a>';
// Находим две ближайшие страницы с обоих краев, если они есть
if($page - 5 > 0) $page5left = ' <a href=index.php?page='. ($page - 5) .'>'. ($page - 5) .'</a> | ';
if($page - 4 > 0) $page4left = ' <a href=index.php?page='. ($page - 4) .'>'. ($page - 4) .'</a> | ';
if($page - 3 > 0) $page3left = ' <a href=index.php?page='. ($page - 3) .'>'. ($page - 3) .'</a> | ';
if($page - 2 > 0) $page2left = ' <a href=index.php?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
if($page - 1 > 0) $page1left = '<a href=index.php?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';
if($page + 5 <= $total) $page5right = ' | <a href=index.php?page='. ($page + 5) .'>'. ($page + 5) .'</a>';
if($page + 4 <= $total) $page4right = ' | <a href=index.php?page='. ($page + 4) .'>'. ($page + 4) .'</a>';
if($page + 3 <= $total) $page3right = ' | <a href=index.php?page='. ($page + 3) .'>'. ($page + 3) .'</a>';
if($page + 2 <= $total) $page2right = ' | <a href=index.php?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = ' | <a href=index.php?page='. ($page + 1) .'>'. ($page + 1) .'</a>';
//вывод сообщений если они есть в таблице
$result = mysqli_query ($conn, "SELECT * FROM autobarachlo ORDER BY id DESC LIMIT $start, $num");
if (!empty($result)) {
 	while ($usermessage = mysqli_fetch_array($result)) {
    echo '<div class="usermessage"><h1>';
    echo $usermessage ["title"] . '<br></h1>
    <p>'; echo $usermessage ["text"] . '<br></p>
    <p class="date"> Дата публикации:'; echo $usermessage ["date"] . '<br></p>
    <p class="time"> Время публикации:';echo $usermessage ["time"] . '<br></p>
    <p class="author"> Автор:'; echo $usermessage ["user"] . '<br></p>
    <a class="';echo $hidden1.'" href = "edit.php?id='.$usermessage ["id"].'">Редактировать сообщение</a>
    <a class="';echo $hidden2.'" href = "delete.php?id='.$usermessage ["id"].'">Удалить сообщение</a></div><hr>'.
    '<br><br><br><br>';
	}
}
else{
echo "Нет ни одной записи";
}
function loginUser($login, $password){
	global $conn; //разрешаем доступ к переменной внутри функции
	$password=md5($password);
    $sql = "SELECT * FROM `users` WHERE
        `login` = '{$login}' and
        `password` = '{$password}'"; //конструируем запрос
    $result = mysqli_query ($conn, $sql); //получаем результаты
    $user = mysqli_fetch_row ($result);
    if(!is_null($user)){
        $_SESSION['user'] = $user;
        echo"<script>document.location.href='index.php';</script>";
            }
    else{
        echo 'Неверный логин или пароль!';
        var_dump($sql);
    }
}
function registerUser($login, $pass, $confirm){
	global $conn;
	$logset = $_POST['login'];
	$sel = "SELECT * FROM users WHERE login = '$login'";
	$res = mysqli_query($conn, $sel);
	$num = mysqli_num_rows($res);
    if($pass!=$confirm){
    	echo '<form>Пароли не совпали</form>';
    }
    else{
    	if ($num == 0) {
    	$password = md5($pass);
        $sql = "INSERT INTO `users` (`login`, `password`) VALUES ('{$login}','{$password}')";
       		if(mysqli_query($conn, $sql)){
            echo"<script>document.location.href='index.php';</script>Вы успешно зарегистрировались!";
            }
        	else{
            echo 'Ошибка при выполнении запроса добавления новости<br/>';
            print mysqli_error();
            }
    	}
    	else{
    	echo '<form>Пользователь с таким именем уже существует</form>';
    	}
    
	}
}
function showRegForm(){
    echo '<form action="?action=register" method="post" class="testreg">
    <label>Логин</label><input class="login" type="text" name="login" /><br/>
    <label>Пароль</label><input class="pass" type="password" name="password" /><br/>
    <label>Подтверждение</label><input class="pass" type="password" name="confirm_password" /><br/>
    <input class="submit" type="submit" value="Зарегистрироваться">
	</form>';
}
function showLoginForm(){
    echo '<form action="?action=login" method="post" class="testreg">
    <label>Логин </label><input class="login" type="text" name="login" /><br/>
    <label>Пароль</label><input class="pass" type="password" name="password" /><br/>
    <input class="submit" type="submit" value="Войти"><br/>
    <div><a href="?action=register">Регистрация</a></div>
	</form>';
}
function isUserLoggedIn(){
    if(!empty($_SESSION['user'])){
        return true;
    }
    else return false;
}
function logoutUser(){
    session_destroy();
    $_SESSION = array();
    header("Refresh: 0; url=index.php");
}
?>
