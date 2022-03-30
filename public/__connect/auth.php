<?php
//авторизация 

//login : pass
//donskoi_k 123456
//rhemes  123456
//user1 123456
//user 12345

$login=filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
$pass=filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);

$pass= md5($pass."jdteghythfa48589");

require_once('bd.php');
$conn = connect();

$query ="SELECT * FROM `users` WHERE `users_login`='$login' AND `users_password`='$pass'";


$result =mysqli_query($conn, $query);//вернет объект данных

//echo is_array($result) ? 'Массив' : 'Не массив';

if(mysqli_num_rows($result)==0){
//echo "Пользователь не найден, повторите ввод данных";
echo "res01";//Пользователь не найден, повторите ввод данных
exit();
}
$user = mysqli_fetch_assoc($result);

echo(json_encode(['records'=>($user)]));
//echo is_array($user) ? 'Массив' : 'Не массив';

//while($row = mysqli_fetch_assoc($result)){			
//    $user[]=$row;}//преобразование в массив

//print_r($result);
//         print_r($user);
//echo count($user); //размер массива
//time()+3600*24 - куки живут 1 сутки
//time()+3600*24*30 - куки живут 30 сутки
// '/' - куки действуют на всех страничках
setcookie('user',$user['users_login'],time()+3600*24*30,"/");
setcookie('pass',$user['users_password'],time()+3600*24*30,"/");
db_close($conn);

//header("Location: login.php"); exit();
//header('Location:../');
?>