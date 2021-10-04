
<?php

session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>نتائج الاختبار </title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

    <style>
    
    .form {
  text-align:right;
  display: block;
  width: 100%;
  height: 200px;

  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
       -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
          transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.form:focus {
  border-color: #66afe9;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
          box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
}
.form::-moz-placeholder {
  color: #999;
  opacity: 1;
}
.form:-ms-input-placeholder {
  color: #999;
}
.form::-webkit-input-placeholder {
  color: #999;
}
.form[disabled],
.form[readonly],
fieldset[disabled] .form {
  cursor: not-allowed;
  background-color: #eee;
  opacity: 1;
}
textarea.form {
  height: auto;
}
    
    
    </style>
 <body style="font-family:Courier New; font-size:13px;">
<?php include('includes/header.php');?>
<a href="exam.php"> <b> <button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
      <!--------------------------------------------------------------------------------------->
 <!-- MENU SECTION END-->
            
    <div class="content-wrapper">
        <div class="container">
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
نتيجة الاختبار                        </div>
        
                        <div class="panel-body">
    <form  method="post" action="resultExam.php" enctype="multipart/form-data">
    <div  class="form-group" align="right" >
      
<?php

session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
    
    
    
  

if(isset($_POST['submit']))
{ 
    $id =$_POST['examID']; 
    $s=$_SESSION['login']; 
    $mark=0;
    $totalMark = 0;
    $markExam = 0;
        
   foreach ($_REQUEST['answer'] as $key => $value) {
    $value = $value['correct'];
   
    $sql = "SELECT exam_answer , eq_mark FROM `exam_question_tbl` where eqt_id='$key' ";
    $result = mysqli_query($con, $sql);

    $qustionData = mysqli_fetch_assoc($result);
    $markExam = $markExam + $qustionData['eq_mark'];

    if($qustionData['exam_answer'] == $value){
        $markcurrect = $qustionData['eq_mark'];
        $insAns = mysqli_query($con,"INSERT INTO exam_answers(student_id,exam_id,quest_id,mark,exans_answer) VALUES('$s','$id','$key','$markcurrect','$value')");
        $totalMark = $totalMark + $markcurrect;

    }else {
        $insAns = mysqli_query($con,"INSERT INTO exam_answers(student_id,exam_id,quest_id,mark,exans_answer) VALUES('$s','$id','$key',$mark,'$value')");
     
    }
    }
    $insAtt = mysqli_query($con,"INSERT INTO exam_attempt(exmne_id,exam_id,mark,markExam) VALUES('$s','$id','$totalMark','$markExam')");

    $extra="exam.php?id=$id";

    $host=$_SERVER['HTTP_HOST'];
    $_SESSION['login']=$s;
    $_SESSION['exam_id']=$row[exam_id];
    $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location:http://$host$uri/$extra");
    exit();

  }} ?>
 
                        
                   

        
                      </div> 
                            
                            
</form>
                           
                            </div>
                    </div>
                  
                </div>
                
            </div>





        </div>
    </div>
 
    <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>