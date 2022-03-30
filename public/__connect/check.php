<?php
//регистрация

//filter_var -УДАЛЯЕТ РАЗНЫЕ СИМВОЛЫ
//FILTER_SANITIZE_STRING -тип фильтрации
$login=filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
$name=filter_var(trim($_POST['sname']),FILTER_SANITIZE_STRING);
$pass=filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);

if(mb_strlen($login)<4 || mb_strlen($login)>40){
    echo 'Не допустимая длина логина';
    exit();
}
if(mb_strlen($name)<4 || mb_strlen($name)>100){
    echo 'Не допустимая длина имени';
    exit();
}
if(mb_strlen($pass)<4 ){
    echo 'Не допустимая длина пароля (от 5 символов)';
    exit();
}
$pass= md5($pass."jdteghythfa48589");

require_once('bd.php');
$conn = connect();
$query = "INSERT INTO `users` (`users_id`,`users_login`,`users_password`,`users_id_rol`) VALUES (NULL,'$login', '$pass','3')";
$result =mysqli_query($conn, $query);


db_close($conn);
header('Location:../')
?>
