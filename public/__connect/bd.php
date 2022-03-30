<?php  
 require_once('constants.php');
 //функция соединения с бд 
function connect(){
          $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
          if(mysqli_connect_errno()) {
            $msg = "Database connection failed: ";
            $msg .= mysqli_connect_error();
            $msg .= " (" . mysqli_connect_errno() . ")";
            exit($msg);
          }else {
            mysqli_set_charset($connection, "utf8");
            
           // echo 'conn is OK.<br />'; # For debugging purposes
        }
        return $connection;
        }
 //лбращение с выполнением запроса     
function db_query($connection, $sql) {
          $result_set = mysqli_query($connection, $sql);
          if(substr($sql, 0, 7) == 'SELECT ') {
            confirm_query($result_set);
          }
          return $result_set;
        }
 //проверка правильности запроса     
function confirm_query($result_set) {
          if(!$result_set) {
            exit("Database query failed...");
          }
        }
//извлекает строку данных из набора и перемещает свой внутренний указатель на следующую строку           
function db_fetch_assoc($result_set) {
          return mysqli_fetch_assoc($result_set);
        }
 //удаляет объект результата и освобождает память, связанную с ним    
function db_free_result($result_set) {
          return mysqli_free_result($result_set);
        }
 //возвращает количество строк в результирующем объекте.    
function db_num_rows($result_set) {
          return mysqli_num_rows($result_set);
        }
      
function db_insert_id($connection) {
          return mysqli_insert_id($connection);
        }
      
function db_error($connection) {
          return mysqli_error($connection);
        }
      
function db_close($connection) {
          return mysqli_close($connection);
        }
