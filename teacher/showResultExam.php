<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}

?>
<?php

// php select option value from database
mysqli_set_charset($con, 'utf8');
?>

<?php

if(isset($_POST['upload']))
{ 
 
    $class=$_POST['class'];
    $subject=$_POST['subject'];
    $examTitle=$_POST['examTitle'];
    $mark=$_POST['mark'];
    $details=$_POST['details'];
    $start_time=date(' Y-m-d   H:iA ', strtotime($_POST['start_time']));
    $end_time=date(' Y-m-d   H:iA ', strtotime($_POST['end_time']));
 
    if($class=='' or $subject=='' or $class=='اختر الصف' or $subject=='اختر المادة'  or $examTitle=='' or $mark==''  or $start_time==''  or $end_time==''){
      $_SESSION['msg']="لم يتم انشاء الاختبار الرجاء كتابة جميع المعلومات واختيارها بالشكل الصحيح";

    }else{
$t=$_SESSION['login'];
$vir = true; 
$q1 =mysqli_query($con,"SELECT class_id FROM exam_tbl WHERE start_time = '$start_time'");
$count=mysqli_num_rows($q1);
if($count>0)
{   
 $vir=false;
 $_SESSION['msg']=" لم يتم انشاء الاختبار وذلك لوجود اختبار لهذا الصف بنفس الموعد";}

if($vir){
$q2 =mysqli_query($con,"SELECT class_id FROM exam_tbl WHERE start_time BETWEEN '$start_time' AND '$end_time' ");
$count=mysqli_num_rows($q2);
if($count>0)
{   
 $vir=false;
 $_SESSION['msg']=" لم يتم انشاء الاختبار وذلك لوجود اختبار لهذا الصف بنفس الفترة";}
}

if($vir){
  $sql="INSERT INTO exam_tbl(teacher_id,class_id,sub_id,start_time,end_time,	ex_title,ex_questlimit_display,ex_description,ex_mark) VALUES('$t','$class','$subject','$start_time','$end_time','$examTitle','$examQuestDipLimit','$details','$mark')";

  
$ret=mysqli_query($con,$sql);
if($ret)
{
$qs=mysqli_query($con,"SELECT * FROM exam_tbl WHERE teacher_id='$t' And class_id='$class' And sub_id='$subject' And ex_title='$examTitle' And start_time='$start_time' And end_time='$end_time'");
$row=mysqli_fetch_assoc($qs);
$extra="addqustion.php?id=<?php echo $row[exam_id]?>";

$host=$_SERVER['HTTP_HOST'];
$_SESSION['alogin']=$t;
$_SESSION['exam_id']=$row[exam_id];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
    $_SESSION['msg']="لم يتم الانشاء بنجاح";
  } }
} }
	
if(isset($_GET['del']))
      {     $de="DELETE FROM exam_question_tbl where exam_id = '".$_GET['id']."'";
            $rt=mysqli_query($con,$de);
       if($rt)
       { 
        $dell="DELETE FROM exam_tbl where exam_id = '".$_GET['id']."'";
        $d=mysqli_query($con,$dell);
        $_SESSION['dm']="تم حذف الاختبار بنجاح";}
      }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>الاختبارات</title>
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
<a href="addexam.php"> <b> <button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
      <!--------------------------------------------------------------------------------------->
    
    <!-- MENU SECTION END-->
             
   
 <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;"> نتائج الاختبار</h1>
                         <hr class="my-5" >
                          <font color="green" align="center"><?php echo htmlentities($_SESSION['dm']);?><?php echo htmlentities($_SESSION['dm']="");?></font>

                    </div>
                </div>

                <div class="panel panel-default">
                             

       
                                 <div class="table-responsive table-bordered">
                                     <table class="table">
                                       <thead>
                                         <tbody>
                                             <tr>
                                                  <th style="text-align:center">#</th>
                                               
                                                  <th style="text-align:center">الطالب</th>
                                                  <th style="text-align:center">علامة الاختبار الكلية</th>
                                                  <th style="text-align:center">علامة الطالب</th>
                                                 
                                                       <th style="text-align:center">الإجراءات</th>
                                             
                                             
                                          <?php     $cnt=1; 
                                            
                                             $id=intval($_GET['id']);
                                              $sql1=mysqli_query($con,"SELECT * FROM `exam_attempt` where exam_id = '$id' ");
                                            while(  $row1=mysqli_fetch_array($sql1))
                                            {
                                             
     
                                                
                                             ?>
                                             <tr>
                                                
                                                 
                                                 <td style="text-align:center"><?php echo $cnt;?></td>
                                              
                                               
                                           <td style="text-align:center"><?php 
                                            
                                             $student_id = $row1['exmne_id'];
                                            $student=mysqli_query($con,"SELECT * FROM `student` where id = $student_id"); 
                                            while ($row2=mysqli_fetch_array($student)) {
                                              
                                                echo htmlentities($row2['first_name'])," ",$row2['second_name']," ",$row2['third_name']," ",$row2['last_name'];
                                            }
   
                                           
                                           
                                           ?></td>

                                           <td style="text-align:center"><?php  $s6=mysqli_query($con,"SELECT * FROM `exam_tbl` where exam_id = '$id' ");
                                            $row6=mysqli_fetch_array($s6);
                                           echo htmlentities($row6['ex_mark']);?></td>
                                          
                                                   <td style="text-align:center"><?php echo htmlentities($row1['mark']);?></td>
                                              
                                                   <td style="text-align:center">
                                                   <form method="post" action="showResultExamStudent.php" > 
                                                   
                                                    <div  align="center">
                                                    <input name="examID" type="hidden" id="examID" value="<?php echo intval($_GET['id']); ?>">
                                                    <input name="studentID" type="hidden" id="studentID" value="<?php echo $student_id; ?>">
 <button type="submit" name="submit" class="btn btn-default" style="background-color:#008000; color:#fff" >عرض </button> </div>
     </form>



                                               
                                                 </td>
                                
                  
                                           
                                 </tbody>     <?php $cnt++;} ?>
         </table>
          </div>
           </div>    
                <hr>       
                     
     
             <?php                   ?>
       
          
       
      
                 <!--    Bordered Table  -->
                 
                 
                         
                 
                 
                 
                 
                 
                 
                 
                 
                                           </div></div>
                                           </div></div>
        
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