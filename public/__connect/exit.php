<?php
setcookie('user',$user['users_login'],time()-3600*24*30,"/");
setcookie('pass',$user['users_password'],time()-3600*24*30,"/");

header('Location:../');
?>