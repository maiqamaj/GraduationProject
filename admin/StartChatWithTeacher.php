<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
$sql =mysqli_query($con,"SELECT id,CONCAT(first_name,' ',second_name,' ',last_name) as full_name FROM teacher");
$teachers = mysqli_fetch_all($sql,MYSQLI_ASSOC);

$sql =mysqli_query($con,"SELECT id,CONCAT(first_name,' ',second_name,' ',last_name) as full_name FROM student");
$students = mysqli_fetch_all($sql,MYSQLI_ASSOC);

?>    
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ادمن | محادثه</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body style="font-family:Courier New; font-size:13px;">
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
 <div class="content-wrapper">
 <div class="container">
       <div class="row">
             <div class="col-md-12">
                 <h1 class="page-head-line">التواصل مع المعلم  </h1>
             </div>
         </div>
<?php include '../includes/startChat.php' ?>
 <!-- CONTENT-WRAPPER SECTION END-->
</div>
</div>
  <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>