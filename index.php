<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="styles.css" rel="stylesheet">
<title>Мой сайт</title>
</head>
<body>
<img src="443434.jpg">
<div class="add"><a href = "add.php"> Добавить сообщение</a></div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
require_once('config.php');
require_once ("functions.php");
if(isUserLoggedIn()){
    if($_GET['action']==logout){
        logoutUser();
    }
    //если пользователь авторизован, поприветствуем его :)
    echo '<form>Здорова, '.$_SESSION['user'][1].'!
    <br><br><br><div class "privet"><a href="?action=logout">Выход</a></div></form>';
}
else{ //если пользователь не авторизован
    //если action не пустой, проверяем, что передано
    switch($_GET['action']){
        case 'register': //если регистрация
            if(!empty($_POST)){//do register
                registerUser($_POST['login'],
                    $_POST['password'], $_POST['confirm_password']);
            }
            else{
                showRegForm();//выводим форму регистрации
            }
            break;
        case 'login':
            if(!empty($_POST)){
                //выполняем авторизацию
                loginUser($_POST['login'], $_POST['password']);
            }
            else{
                //иначе показываем форму авторизации
                showLoginForm();
            }
            break;
        default:
            showLoginForm();
            break; //в других случаях показываем форму авторизации :)
    }
}

// Вывод меню страниц, если страниц больше одной
if ($total > 1) {
	Error_Reporting(E_ALL & ~E_NOTICE);
	echo "<div class=\"pstrnav\">";
	echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;
	echo "</div>";
	}
?>

</body>
</html>