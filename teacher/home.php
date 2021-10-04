<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> صفحه المعلم </title>
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

<body  style="font-family:Courier New;   background-color: #f7f9fb;  margin:0; ">
    <?php include('includes/headerMain.php');?>    
    <!--Main layout-->
    <main class="mt-5 pt-5"> 

   
        <div class="containerr" style="padding-right:170px;padding-left:170px;">
            <section class="text-center">
                <div class="row mb-4 fadeIn" >
                    

<!--Grid column-->
 <div class="col-lg-4 col-md-6 mb-4" style="flex:0 0 25%;">  <!--Card--> <div class="cardd">
			 
     <a href="info_teacher.php">  <button class="button"><img src="img/personal-information.png"  class="cardd-img"><h3 style="font-size:19px;"><b>المعلومات الشخصية</b></h3></button></a> </div>
</div>
 <div class="col-lg-4 col-md-6 mb-4" style="flex:0 0 25%;">   <!--Card--> <div class="cardd"><a href="teacher_studentinfo.php">   
     <button class="button"> <img src="img/design.png"  class="cardd-img"> <h3 >بيانات الطلاب</h3></button></a></div>
</div>
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"> <!--Card--> <div class="cardd"><a href="attend-absence.php"> 
    <button class="button"><img src="img/abcent.png"  class="cardd-img"> <h3>حضور وغياب</h3></button></a></div><!--/.Card-->
</div>
<!--Grid column-->
<div class="col-lg-4 col-md-12 mb-4"style="flex:0 0 25%;">  <!--Card--><!--Card--> <div class="cardd">
              <a href="marks.php">    <button class="button"><img src="img/score.png"  class="cardd-img">  <h3>جدول العلامات</h3></button></a></div>
</div>
<!--Grid column-->
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--><!--Card--> <div class="cardd"><a href="lesson_teacher.php"> 
    <button class="button"><img src="img/video-lesson.png"  class="cardd-img"> <h3>الدروس</h3></button><!--/.Card--></a></div></div>
<!--Grid column--> 
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--><!--Card--> <div class="cardd"><a href="schedule.php">
                 <button class="button"><img src="img/schedule.png"  class="cardd-img"> <h3>الجدول الدراسي</h3></button></a></div></div><!--/.Card-->
<!--Grid column--> 
 <div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;">  <!--Card--> <!--Card--> <div class="cardd">
     <a href="competition.php">         <button class="button"><img src="img/competition.png"  class="cardd-img"> <h3>مسابقات</h3></button></a></div></div>

<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;">  <!--Card--> <!--Card--> <div class="cardd"><a href="meeting.php">
    <button class="button"><img src="img/meeting.png"  class="cardd-img"> <h3>اجتماعات</h3></button></a></div>
</div>

<!--Grid column-->
<div class="col-lg-4 col-md-12 mb-4"style="flex:0 0 25%;">  <!--Card--><!--Card--> <div class="cardd">
  <a href="ContatWith.php">
              
      <button class="button"><img src="img/mai.png"  class="cardd-img"> <h3>دردشه</h3></button></a></div></div>

<!--Grid column-->
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--><!--Card--> <div class="cardd">
              <a href="addexam.php">   <button class="button"><img src="img/quiz.png"  class="cardd-img"> <h3>اختبارات</h3></button></a><!--/.Card--></div></div>

<!--Grid column-->        
<div class="col-lg-4 col-md-12 mb-4"style="flex:0 0 25%;">  <!--Card--> <!--Card--> <div class="cardd"><a href="homework.php">
    <button class="button"><img src="img/homework.png"  class="cardd-img"> <h3>واجبات</h3></button></a></div></div>

<!--Grid column-->     
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--><!--Card--> <div class="cardd"><a href="addLesson.php">
    <button class="button"><img src="img/lesson.png"  class="cardd-img"><h3>دروس تقويه</h3></button><!--/.Card--></a></div></div>
				 
<!--Grid column-->
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--><!--Card--> <div class="cardd"><a href="showLessonTeacher.php">
                 <button class="button"><img src="img/online-course.png"  class="cardd-img"><h3>كورسات تعزيز</h3></button><!--/.Card--></div></div>
<!--Grid column--> 
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--><!--Card--> <div class="cardd">
<a href="change-password.php">
                 <button class="button"><img src="img/privacy.png"  class="cardd-img"> <h3>كلمة السر</h3></button></a></div></div>
<!--Grid column-->        
<!--Grid column-->        
<div class="col-lg-4 col-md-6 mb-4"style="flex:0 0 25%;"><!--Card--> <div class="cardd">
<a href="logout.php">
    <button class="button"><img src="img/logout.png"  class="cardd-img"> <h3>تسجيل الخروج</h3></button></a></div></div>
                 
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