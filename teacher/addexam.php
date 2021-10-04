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
  $nuum='2';
    $class=$_POST['class'];
    $subject=$_POST['subject'];
    $examTitle=$_POST['examTitle'];
    $mark=$_POST['mark'];
    $details=$_POST['details'];
	date_default_timezone_set('Asia/Amman');
    $n = date("Y-m-d H:i:sA", strtotime('0 hours'));
     $start_time=date('Y-m-d  H:iA', strtotime($_POST['start_time']));
  $end_time=date('Y-m-d H:iA', strtotime($_POST['end_time']));
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
  $sql="INSERT INTO exam_tbl(teacher_id,class_id,sub_id,start_time,end_time,	ex_title,ex_questlimit_display,ex_description,ex_created,ex_mark) VALUES('$t','$class','$subject','$start_time','$end_time','$examTitle','$examQuestDipLimit','$details','$n','$mark')";

  
$ret=mysqli_query($con,$sql);
    
    $cl= mysqli_query($con,"select exam_id from exam_tbl where teacher_id = '$t' and class_id = '$class' and sub_id = '$subject' and  start_time = '$start_time'
   and end_time = '$end_time' and ex_created = '$n'
   ");
   $clasq= mysqli_fetch_array($cl);
   $ttt= $clasq['exam_id'];

    
     
     $ss="INSERT INTO notification(teacher,num_notification,id_note,class,subject,currentdate) VALUES('$t',$nuum,'$ttt','$class','$subject','$n')";
      $rr=mysqli_query($con,$ss);
   
if($ret)
{
$qs=mysqli_query($con,"SELECT * FROM exam_tbl WHERE teacher_id='$t' And class_id='$class' And sub_id='$subject' And ex_title='$examTitle' And start_time='$start_time' And end_time='$end_time'");
$row=mysqli_fetch_assoc($qs);
$extra="addqustion.php?id=$row[exam_id]";

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
       
          $dedada="DELETE FROM notification where id_note = '".$_GET['id']."'";
            $rfff=mysqli_query($con,$dedada);
       $de="DELETE FROM ajaxsave where id_hom = '".$_GET['id']."'";
                           $rnnn=mysqli_query($con,$de); 
       
       
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
<a href="home.php"> <b> <button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
      <!--------------------------------------------------------------------------------------->
    
    <!-- MENU SECTION END-->
             
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">الاختبارات</h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
اضافة اختبار                        </div>
                             <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>

                        <div class="panel-body">
    <form  method="post" enctype="multipart/form-data">
    <div  class="form-group" align="right" >
        
        
        
        
			<label for="class">الصف</label> <select  id="class" name="class"  class="form-control" required="">   
        <option  value="" disabled selected hidden>اختر الصف</option>
   <?php
           $saa=mysqli_query($con,"select DISTINCT class from `addtable` where teacher='".$_SESSION['login']."' ");
                         while($da= mysqli_fetch_array($saa))
            {       
                          $class1=$da['class'];
                          $cl= mysqli_query($con,"select * from course where id = '$class1'");
                          $class= mysqli_fetch_array($cl);
   ?>     
     
        
            <option  value="<?php echo $class[0];?>">
                <?php echo $class[1]," ",$class[2]; ?>
            </option>
            <?php   }?>
        </select>
        
        
           
			<label for="subject">المادة</label> <select  id="subject" name="subject"  class="form-control" required="">   
         <option  value="" disabled selected hidden>اختر المادة</option>
   <?php
           $saa=mysqli_query($con,"select DISTINCT subject from `addtable` where teacher='".$_SESSION['login']."' ");
                         while($da= mysqli_fetch_array($saa))
            {       
                          $class1=$da['subject'];
                          $cl= mysqli_query($con,"select * from subject where id = '$class1'");
                          $class= mysqli_fetch_array($cl);
   ?>
            <option  value="<?php echo $class[0];?>">
                <?php echo $class[1]; ?>
            </option>
            <?php   }?>
        </select>
        
        
        
		</div><!--
    <div class="form-group">
            <label>مدة الاختبار</label>
            <select class="form-control" name="مدة الاختبار" required="">
              <option value="0">اختر المدة</option>
              <option value="10">10 دقائق</option> 
              <option value="20">20 دقيقة</option> 
              <option value="30">30 دقيقة</option> 
              <option value="40">40 دقيقة</option> 
              <option value="50">50 دقيقة</option> 
              <option value="60">60 دقيقة</option> 
              <option value="110">110 دقيقة</option> 
              <option value="120">120 دقيقة</option> 
              <option value="130">130 دقيقة</option> 
              <option value="140">140 دقيقة</option> 
              <option value="150">150 دقيقة</option> 
              <option value="160">160 دقيقة</option> 
              <option value="170">170 دقيقة</option>
              <option value="180">180 دقيقة</option> 
              <option value="190">190 دقيقة</option> 
              <option value="200">200 دقيقة</option>  
            </select>
          </div>

          <div class="form-group">
            <label>عدد اﻷسئلة</label>
            <input type="number" name="examQuestDipLimit" id="" class="form-control" placeholder="عدد الاسئلة" required="">
          </div>-->
          <div class="form-group">
            <label> العلامة الكلية</label>
            <input type="number" name="mark" id="" class="form-control" placeholder="العلامة الكلية" required="">
          </div>

          <div class="form-group">
            <label>عنوان الاختبار</label>
            <input type="" name="examTitle" class="form-control" placeholder="عنوان الاختبار" required="">
          </div> 

     <div  class="form-group" align="right" >
			<label for="class">بداية الاختبار</label> 
         <input type="datetime-local" id="start_time" name="start_time" class="form-control" required=""></div>
    
     <div  class="form-group" align="right" >
			<label for="class">نهاية الاختبار</label> 
         <input type="datetime-local" id="end_time" name="end_time" class="form-control" required=""></div>
        
     <div  class="form-group" align="right" >
			<label for="details">تفاصيل/ملاحظات</label> <br/>
         <textarea  type="text" id="details" name="details"class="form" rows="5" cols="50" ></textarea></div>
    
    
    
  <div  align="center">
 <button type="submit" name="upload" class="btn btn-default" style="background-color:#6F479F; color:#fff" >انشاء</button> </div>
    
     
   
    
</form>

 </div>
                    
 </div> </div>
 </div>

 <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">الاختبارات المضافة</h1>
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
                                               
                                                  <th style="text-align:center">المادة</th>
                                                  <th style="text-align:center">عنوان الاختبار</th>
                                                  <th style="text-align:center">الصف</th>
                                                  <th style="text-align:center">  موعد بداية الاختبار</th>
                                                      <th style="text-align:center">موعد نهاية الاختبار</th>
                                                      <th style="text-align:center"> عدد الاسئلة</th>
                                                     <th style="text-align:center">العلامة الكلية</th>
                                                      
                                                       <th style="text-align:center"> تفاصيل/ملاحظات </th>
                                                       <th style="text-align:center">الإجراءات</th>
                                             
                                             
                                          <?php     $cnt=1; 
                                             $exam_id=$_SESSION['exam_id']; 
                                             $t=$_SESSION['login'];
                                              $sql1=mysqli_query($con,"SELECT DISTINCT * FROM `exam_tbl` where teacher_id = '$t' ");
                                            while(  $row1=mysqli_fetch_array($sql1))
                                            {
                                             
     
                                                
                                             ?>
                                             <tr>
                                                
                                                 
                                                 <td style="text-align:center"><?php echo $cnt;?></td>
                                              
                                               
                                           <td style="text-align:center"><?php 
                                            
                                             $sub_id = $row1['sub_id'];
                                            $sub=mysqli_query($con,"SELECT * FROM `subject` where id = $sub_id"); 
                                            while ($row2=mysqli_fetch_array($sub)) {
                                                echo $row2['subjectName'];
                                            }
   
                                           
                                           
                                           ?></td>
                                           <td style="text-align:center"><?php echo htmlentities($row1['ex_title']);?></td>
                                           <td style="text-align:center"><?php 
                                            $class_id = $row1['class_id'];
                                            $class=mysqli_query($con,"SELECT * FROM `course` where id = $class_id ");
                                            while ($row3=mysqli_fetch_array($class)) {
                                              echo htmlentities($row3['className'])," ",$row3['numOfSection'];
                                           }
  
                                           
                                           $x=substr($row1['start_time'], 0, 11);
   $x1=substr($row1['start_time'],10,10);
   $X=substr($row1['end_time'], 0, 10);
   $X1=substr($row1['end_time'],10,10);
                                           
                                           ?></td>
                                                   <td style="text-align:center"><?php echo 'التاريخ : ',$x,'</br>','الساعة :',$x1; ?></td>
                     
                                         <td style="text-align:center"><?php echo 'التاريخ : ',$X,'</br>','الساعة :',$X1; ?></td>     
                                                      <td style="text-align:center"><?php echo htmlentities($row1['ex_questlimit_display']);?></td>
                                                      <td style="text-align:center"><?php echo htmlentities($row1['ex_mark']);?></td>
                                                      
                                                      <td style="text-align:center"><?php echo htmlentities($row1['ex_description']);?></td>
                                                   <td style="text-align:center">
                                                      
                                                   <a href="showResultExam.php?id=<?php echo $row1['exam_id']?>">
                                                <button class="btn btn-primary" style="background-color:#008000;"> عرض</button> </a>  
                                                      
                                                      
                                                 <a href="edit-exam.php?id=<?php echo  $row1['exam_id']?>">
                                                     <button class="btn btn-primary" ><i class="fa fa-edit " ></i> تعديل</button> </a>                                         
       <a href="addexam.php?id=<?php echo  $row1['exam_id']?>&del=delete" onClick="return confirm('هل أنت متأكد من حذف الاختبار')">
                                                 <button class="btn btn-danger" style="background-color:#DC143C">حذف</button>
     </a>
     
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