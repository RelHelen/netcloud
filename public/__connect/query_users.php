<?php
require_once('bd.php');
$conn = connect();

  $query1 = "SELECT * FROM users WHERE users_id=1";
  // WHERE users_id=1
  //echo '$query1== '.$query1;
  $result1 =mysqli_query($conn, $query1);
  //$i=0;
  if($result1){
	  // echo mysqli_num_rows($result1);
		while($row = mysqli_fetch_assoc($result1)){			
			 $MyArray[]=$row;			 
			 //$name = $row["users_login"];
			 //$userpass = $row["users_password"];
			 //echo "<br>Name: ".$name. "  Pass: ".$userpass."<br/>";
			// echo '<br>$MyArray[]:  '.$MyArray[$i]["users_login"]."<br/>";			 	
		}		
		if (mysqli_num_rows($result1)>0)
		{
			// Возвращает JSON-представление данных
			db_free_result($result1);
			echo(json_encode(['records'=>($MyArray)]));

		}else{
			echo(json_encode(``));}			
	}
	else{
		echo(json_encode(``));		//$MyArray= [];
		//echo "Ошибка: " . mysqli_error($conn);
	}
	
	db_close($conn);

	


	//mysqli_close($conn);
/*
	$response = array();
	$query2 = "SELECT * FROM roles";
	
	$result2 = mysqli_query( $conn,$query2);
 
$response["items"] = array();
$rol = array();
while($row2 = mysqli_fetch_assoc($result2)){
    

    $rol["id"] = $row2["roles_id"];
    $rol["title"] = $row2["roles_name"];

    array_push($response["items"], $rol);
	//print_r($response);
}
$response["success"] = 1;
echo '<br><br><br>roles:  '.json_encode($response);
	//mysqli_close($conn);
*/
// Функция mysqli_fetch_array() выбирает текущую строку из набора в переменную $row и переходит к следующей. Когда строк не останется, метод возвратит false, и произойдет выход из цикла.

// После окончания работы с полученным набором строк мы можем очистить отведенную для него память с помощью функции mysqli_free_result(), в которую передается полученный набор строк:

   
