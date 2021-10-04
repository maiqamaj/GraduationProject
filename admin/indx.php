<?php
session_start();


$username = "";
$password="";
$errors=array();
$_SESSION['success']="";


define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'onlinecourse');
$db = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);


    
      $username =  $_POST['email'];
      $password =  $_POST['password'];


      if(empty($username)){ array_push($errors, "username is required");}
      if(empty($password)){ array_push($errors, "Password is required");}


      if (count($errors) == 0){

		

        //$password=md5($password);
        $query = "SELECT * FROM student WHERE id='$username' AND password='$password'";
        $results =mysqli_query($db,$query);
        echo $query;
		


        if (mysqli_num_rows($results) == 1) {

          $_SESSION['username'] = $username;
          $_SESSION['success'] = "Login is succesed  ";
		  header('location: ./main-student.html');

		  
        }else {
          array_push($errors, " Error in username or password");
        }

    }
	else
	{
		for($i=0;$i<count($errors) ;$i++)
		echo $errors[$i]." / ";
	}

  
?>