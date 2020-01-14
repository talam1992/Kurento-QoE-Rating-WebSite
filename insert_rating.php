<?php

$connect = new PDO('mysql:host=localhost;dbname=kmsqoex1_rating', 'kmsqoex1_db', 'password123..');

if(isset($_POST["index"], $_POST["kurento_id"]))
{
 $query = "
 INSERT INTO rating(kurento_id, rating) 
 VALUES (:kurento_id, :rating)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':kurento_id'  => $_POST["kurento_id"],
   ':rating'   => $_POST["index"]
  )
 );
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'done';
 }
}

if(isset($_POST['username'], $_POST['room']))
{
    $query = "
    INSERT INTO rating(username, room)
    VALUES (:username, :room)
    ";
    $statement = $connect->prepare($query);
    $statement->execute(
     array(
         ':username' => $_POST["username"],
         ':room' => $_POST["room"]
     )
    );
    $result = $statement->fetchAll();
 if(isset($result))
 echo "Thank you for taking part in this survey";
 
}

?>
