<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}

?>

<?php

if(isset($_POST['noti']))
{
      $extra='notification.php';
        
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
  ?>  


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> صفحه الطالب </title>
  <!-- facebook/github Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
      <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />

</head>

<body  style="font-family:Courier New;  margin:0; ">
    <?php include('includes/headerMain.php');?>    
    <!--Main layout-->
    <main class="mt-5 pt-5"> 

   
        <div class="containerr"  style="padding-right:170px;padding-left:170px;">
            <section class="text-center">
                <div class="row mb-4 wow fadeIn" >
                    
   

<!--Grid column-->
 <div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;">  <!--Card--> <div class="cardd"><a href="info_student.php">
			 
     <button class="button"><img src="img/personal-information.png"  class="cardd-img"><h3 style="font-size:19px;"><b>المعلومات الشخصية</b></h3></button></a> </div>
</div>
 <div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;">   <!--Card--> <div class="cardd">
     <a href="schedule.php">   <button class="button"> <img src="img/schedule.png"  class="cardd-img"> <h3>الجدول الدراسي</h3></button></a></div>
</div>
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"> <!--Card--> <div class="cardd">
            <a href="exam.php"><button class="button"><img src="img/quiz.png"  class="cardd-img"> <h3>اختبارات</h3></button></a></div><!--/.Card-->
</div>
<!--Grid column-->       
<div class="col-lg-4 col-md-12 mb-4"style="flex:0 0 25%;">  <!--Card--><!--Card--> <div class="cardd"><a href="lesson_student.php">
    <button class="button"><img src="img/video-lesson.png"  class="cardd-img">  <h3>الدروس</h3></button></a></div>
</div>
<!--Grid column-->
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--><!--Card--> <div class="cardd">
    <a href="homework.php"> <button class="button"><img src="img/homework.png"  class="cardd-img"> <h3>الواجبات</h3></button><!--/.Card--></a></div></div>
<!--Grid column--> 
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--><!--Card--> <div class="cardd">
                 <a href="total.php"> <button class="button"><img src="img/summa-cum-laude.png"  class="cardd-img"> <h3>المعدل</h3></button></a></div></div><!--/.Card-->
<!--Grid column--> 
                     <?php 
                    $z=0;
                    
                      $sql=mysqli_query($con,"SELECT * FROM `student` where id='".$_SESSION['login']."' ");
                                $class= mysqli_fetch_array($sql);
         $cl= mysqli_query($con,"select * from notification where  class='".$class['section_id']."' ");
            $y=0;
           while($da=mysqli_fetch_array($cl))
           { $y++;
           }
              $cl= mysqli_query($con,"select * from ajaxsave where id_student='".$_SESSION['login']."'");
                     $x=0;
           while($da=mysqli_fetch_array($cl))
           { $x++;
           }
                    
           $z=$y-$x;
            if($z<0) $z=0;        
         ?>
 <div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;">  <!--Card--> <!--Card--> <div class="cardd">
     
     <form method="post">
         
         
   
           <button class="button" type="submit" name="noti" id="noti"><img src="img/bell.png"  class="cardd-img"> <h3>اشعارات</h3>
         
           <div style="                                             
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  border-radius: 50%;
  -moz-background-clip: padding-box;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  background: #FF0000;
  color: #fefefe;
  font: normal 0.85em 'Lato';
                       
  height: 35px;
  line-height: 2.75em;
  position: absolute;
  right: 2px;
  text-align: center;
  top: -2px;
  width: 35px;"><b ><?php echo $z;?></b></div>
         
         
         
         </button> </form>     </div></div>
                    
                    
                    
              
                    
                    

<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;">  <!--Card--> <!--Card--> <div class="cardd"><a href="show_meeting.php">
    <button class="button"><img src="img/meeting.png"  class="cardd-img"> <h3>اجتماعات</h3></button></a></div>
</div>

<!--Grid column-->
<div class="col-lg-4 col-md-12 mb-4"style="flex:0 0 25%;">  <!--Card--><!--Card--> <div class="cardd">
              <a href="mark.php">   <button class="button"><img src="img/test.png"  class="cardd-img"> <h3>علامات</h3></button></a></div></div>

<!--Grid column-->
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--><!--Card--> <div class="cardd">
                 <a href="attendance.php">   <button class="button"><img src="img/abcent.png"  class="cardd-img"> <h3>حضور وغياب</h3></button></a><!--/.Card--></div></div>
<!--Grid column--> 
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--><!--Card--> <div class="cardd"><a href="show_lesson_rienforcment.php">
    <button class="button"><img src="img/lesson.png"  class="cardd-img"> <h3>دروس تقوية</h3></button><!--/.Card--></a></div></div>
<!--Grid column-->        
<div class="col-lg-4 col-md-12 mb-4"style="flex:0 0 25%;">  <!--Card--> <!--Card--> <div class="cardd">
    <a href="ContatWith.php">
              
        <button class="button"><img src="img/mai.png"  class="cardd-img"> <h3 style="font-size:19px;"><b>اسال المعلم(دردشة)</b></h3></button></a></div></div>

<!--Grid column-->
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--><!--Card--> <div class="cardd"><a href="competition_student.php">
    <button class="button"><img src="img/competition.png"  class="cardd-img"><h3>مسابقات</h3></button><!--/.Card--></a></div></div>
<!--Grid column--> 
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--><!--Card--> <div class="cardd">
              <a href="change-password.php">   <button class="button"><img src="img/privacy.png"  class="cardd-img"> <h3>كلمة السر</h3></button></a><!--/.Card--></div></div>
<!--Grid column-->        
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--> <div class="cardd">
<a href="logout.php">
    <button class="button"><img src="img/logout.png"  class="cardd-img"> <h3>تسجيل الخروج</h3></button></a></div></div><!--/.Card-->

</div> 
 
</section>
       
</div>
                     <!--  End  Bordered Table  -->
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