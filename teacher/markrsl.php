<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}

?>
<a href="markstd.php"> <b> <button  style="position: absolute;
 left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
<?php

// php select option value from database
mysqli_set_charset($con, 'utf8');
?>

<?php
if(isset($_GET['del']))
{     $de="DELETE FROM exam_question_tbl where exam_id = '".$_GET['id']."'";
      $rt=mysqli_query($con,$de);
 if($rt)
 { 
  $dell="DELETE FROM exam_tbl where exam_id = '".$_GET['id']."'";
  $d=mysqli_query($con,$dell);
  $_SESSION['dm']="تم حذف الاختبار بنجاح";}
}

if(isset($_POST['save']))
{ $class=$_POST['class'];
  $subject=$_POST['sub'];
  $student = $_POST['studentID'];

  $mark_1=$_POST['mark1'];
  $mark_2=$_POST['mark2'];
  $mark_3=$_POST['mark3'];
  $mark_4=$_POST['mark4'];
  $total = $mark_1+$mark_2+$mark_3+$mark_4;
  $check = true;
	$q1 =mysqli_query($con,"SELECT * FROM `mark` where id_student = '$student' AND id_section = '$class' AND id_subject = '$subject' ") or die(mysqli_error($con));
           
if (mysqli_num_rows($q1) > 0) {
    
$update = "UPDATE mark SET id_student='$student' , id_section= '$class', id_subject= '$subject', first_mark= '$mark_1', sec_mark= '$mark_2', third_mark= '$mark_3', final_mark= '$mark_4', total= '$total' where id_student = '$student' AND id_section = '$class' AND id_subject = '$subject'";
$results=mysqli_query($con,$update ) or die(mysqli_error($con));
$check  = false;
}

if($check ){
	$ret=mysqli_query($con,"insert into mark(id_student,id_section,id_subject,first_mark,sec_mark,third_mark,final_mark,total) values('$student','$class','$subject','$mark_1','$mark_2','$mark_3','$mark_4','$total')") or die(mysqli_error($con));
  if($ret)
{
  $_SESSION['msg']="تم الاضافة بنجاح";
}
else
{
    $_SESSION['msg']="لم تتم الاضافة بنجاح";
  } }}
if(isset($_POST['submit']))
{ 
 
    $class=$_POST['class'];
    $subject=$_POST['sub'];
    $student = $_POST['studentID'];

   
 

}


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>العلامات</title>
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
<body  style="font-family:Courier New;  margin:0; ">

<?php include('includes/header.php');?>
<form method="post" action="markstd.php" > 
<input name="class" type="hidden" id="class" value="<?php echo $class; ?>">
<input name="sub" type="hidden" id="sub" value="<?php echo $subject; ?>">
<input name="studentID" type="hidden" id="studentID" value="<?php echo $_SESSION['login']; ?>">
<button type="submit" name="submit" class="btn btn-default" style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;" >العوده  </button> </div>
    </form>

      <!--------------------------------------------------------------------------------------->
    
    <!-- MENU SECTION END-->
             
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">العلامات</h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
اضافه العلامات                       </div>
                               <form  method="post" enctype="multipart/form-data" action="markstd.php">
    <div  class="form-group" align="right" >
        
                   
    <label for="first_name" align="right">اسم الطالب</label>
    <?php  $sql1=mysqli_query($con,"SELECT * FROM `student` where id = '$student' ");
           $row1=mysqli_fetch_array($sql1);
                                        ?>
    <input type="text" class="form-control" id="first_name" name="first_name" disabled placeholder="" value="<?php echo htmlentities($row1['first_name'])," ",$row1['second_name']," ",$row1['third_name']," ",$row1['last_name'];
                                                ?>" required />
  </div>
  <?php  $sql2=mysqli_query($con,"SELECT * FROM `mark` where id_student = '$student' AND id_section = '$class' AND id_subject = '$subject' ") or die(mysqli_error($con));;
           
           $row2=mysqli_fetch_array($sql2);

         
          
                                        ?>   
         <div class="form-group" align="right">
    <label for="mark1">التقييم الاول </label>
    <input type="number" class="form-control" id="mark1" name="mark1" value="<?php echo htmlentities($row2['first_mark']); ?>" />
   </div>
   
   <div class="form-group" align="right">
    <label for="mark2">التقييم الثاني</label>
    <input type="number" class="form-control" id="mark2" name="mark2" value="<?php echo htmlentities($row2['sec_mark']); ?>" />
   </div>
   
   <div class="form-group" align="right">
    <label for="mark3">التقييم الثالث </label>
    <input type="number" class="form-control" id="mark3" name="mark3" value="<?php echo htmlentities($row2['third_mark']); ?>" />
   </div>
   
   <div class="form-group" align="right">
    <label for="mark4">التقييم النهائي </label>
    <input type="number" class="form-control" id="mark4" name="mark4" value="<?php echo htmlentities($row2['final_mark']); ?>" />
   </div>
   
   <input name="class" type="hidden" id="class" value="<?php echo $class; ?>">
   <input name="sub" type="hidden" id="sub" value="<?php echo $subject; ?>">
   <input name="studentID" type="hidden" id="studentID" value="<?php echo htmlentities($row1['id']); ?>">   
   
   
  <div  align="center">
 <button type="submit" name="edit" class="btn btn-default" style="background-color:#6F479F; color:#fff" >انشاء</button> </div>
<?php?>

    
   
    
</form>

 </div>
                    
 </div> </div>
 </div>

     
              
       
          
       
      
                 <!--    Bordered Table  -->
                 
                 
                         
                 
                 <!--    Bordered Table  -->
                 
                 
                         
                 
                 
                 
                 </div></div></div>
                 
                 
                 
                 
                                           
        
         </main>
      
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