<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
    
    
    
    
    $id=intval($_GET['id']);

if(isset($_POST['upload']))
{ 
 
    $class=$_POST['class'];
    $subject=$_POST['subject'];
 
    $examTitle=$_POST['examTitle'];
    $mark=$_POST['mark'];
    $details=$_POST['details'];
    $start_time=date(' Y-m-d   H:iA ', strtotime($_POST['start_time']));
    $end_time=date(' Y-m-d   H:iA ', strtotime($_POST['end_time']));
	date_default_timezone_set('Asia/Amman');
   $n = date("Y-m-d H:i:sA", strtotime('0 hours'));

    if($class=='' or $subject=='' or  $examTitle=='' or $mark==''  or $start_time==''  or $end_time==''){
      $_SESSION['msg']="لم يتم يتم التعديل بنجاح الرجاء كتابة جميع المعلومات واختيارها بالشكل الصحيح";

    }else{
$t=$_SESSION['login'];
$vir = true; 
$q1 =mysqli_query($con,"SELECT class_id FROM exam_tbl WHERE start_time = '$start_time' and exam_id <> {exam_id = '".$_GET['id']."'}");
$count=mysqli_num_rows($q1);
if($count>0)
{   
 $vir=false;
 $_SESSION['msg']=" لم يتم التعديل بنجاح وذلك لوجود اختبار لهذا الصف بنفس الموعد";}

if($vir){
$q2 =mysqli_query($con,"SELECT class_id FROM exam_tbl WHERE start_time BETWEEN '$start_time' AND '$end_time' AND exam_id <> {exam_id = '".$_GET['id']."'} ");
$count=mysqli_num_rows($q2);
if($count>0)
{   
 $vir=false;
 $_SESSION['msg']=" لم يتم التعديل بنجاح وذلك لوجود اختبار لهذا الصف بنفس الفترة";}
}

if($vir){


  $sql="update exam_tbl set teacher_id = '$t',class_id = '$class',sub_id = '$subject',start_time = '$start_time',end_time = '$end_time',	ex_title = '$examTitle',ex_description = '$details',ex_created='$n',ex_mark = '$mark' where exam_id='$id'";
    
$ret=mysqli_query($con,$sql);
    
    
    $cl= mysqli_query($con,"select id_note from notification where id_note='$id'");
   $clasq= mysqli_fetch_array($cl);

 if($clasq==0)
     { $t=$_SESSION['login'];
     $ss="INSERT INTO notification(teacher,num_notification,id_note,class,subject,currentdate) VALUES('$t','2','$id','$class','$subject','$n')";
      $rr=mysqli_query($con,$ss);}
    else {$ttt= $clasq[0];
    $rrr=mysqli_query($con,"update notification set class='$class',subject='$subject',num_notification='2',currentdate='$n' where id_note='$id'");
     }
    
    
if($ret)
{
$qs=mysqli_query($con,"SELECT * FROM exam_tbl WHERE teacher_id='$t' And class_id='$class' And sub_id='$subject' And ex_title='$examTitle' And start_time='$start_time' And end_time='$end_time'");
$row=mysqli_fetch_assoc($qs);
$extra="edit-exam2.php?id=<?php echo $row[exam_id]?>";

$host=$_SERVER['HTTP_HOST'];
$_SESSION['alogin']=$t;
$_SESSION['exam_id']=$row[exam_id];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
    $_SESSION['msg']="لم يتم التعديل بنجاح";
  } }
} }}
	
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
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">الاختبارات</h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
تعديل الاختبار                        </div>
                             <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>

                        <div class="panel-body">
    <form  method="post" enctype="multipart/form-data">
    <div  class="form-group" align="right" >
    <?php     
$sql=mysqli_query($con,"select * from exam_tbl where exam_id='$id'");
$cnt=1;     
while($row=mysqli_fetch_array($sql))
{ 
?>

  <?php     
    
$query = "SELECT DISTINCT class FROM addtable where teacher='".$_SESSION['login']."' ";
$result2 = mysqli_query($con, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{     $class1=$row2['class'];
                          $cl= mysqli_query($con,"select * from course where id = '$class1'");
                          $class= mysqli_fetch_array($cl);
  
 
 
    if($row2[0] == $row[2]){
        $slc = "selected";
    }else{
        $slc=null;
    }
                        
   
    $options = $options."<option value= $row2[0]  $slc > $class[1] &nbsp; $class[2]</option>";
     
}

 
?>

<div class="form-group" align="right">
    <label for="class">الصف</label>&nbsp; &nbsp;
    <select id="class" name="class"  class="form-control" >  
            <?php echo $options;?>
        </select>

  </div>

<!------------------------------------------------>

<?php } ?>
      
<?php     
$sql=mysqli_query($con,"select * from exam_tbl where exam_id='$id'");
$cnt=1;     
while($row=mysqli_fetch_array($sql))
{ 
?>

  <?php     
    
$query = "SELECT DISTINCT subject FROM addtable where teacher='".$_SESSION['login']."' ";
$result2 = mysqli_query($con, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{     $class1=$row2['subject'];
                          $cl= mysqli_query($con,"select * from subject where id = '$class1'");
                          $class= mysqli_fetch_array($cl);
  
 
 
    if($row2[0] == $row[3]){
        $slc = "selected";
    }else{
        $slc=null;
    }
                        
   
    $options = $options."<option value= $row2[0]  $slc > $class[1]</option>";
     
}

 
?>

<div class="form-group" align="right">
    <label for="subject">المادة</label>&nbsp; &nbsp;
    <select id="subject" name="subject"  class="form-control" >  
            <?php echo $options;?>
        </select>

  </div>

<!------------------------------------------------>

<?php } ?>       
           
        
<?php
        $sql=mysqli_query($con,"select * from exam_tbl where exam_id='$id'");

while($row=mysqli_fetch_array($sql))
{
?>     
         <!-- <div class="form-group">
            <label>عدد اﻷسئلة</label>
            <input type="number" name="examQuestDipLimit" id="" class="form-control" placeholder="عدد الاسئلة" required="">
          </div>-->
          <div class="form-group">
            <label> العلامة الكلية</label>
            <input type="number" name="mark" id="" class="form-control" placeholder="العلامة الكلية" required="" value="<?php echo htmlentities($row['ex_mark']);?>">
          </div>

          <div class="form-group">
            <label>عنوان الاختبار</label>
            <input type="" name="examTitle" class="form-control" placeholder="عنوان الاختبار" required="" value="<?php echo htmlentities($row['ex_title']);?>">
          </div> 

     <div class="form-group" align="right">
    <label for="start_time" align="right">بداية الاختبار</label>
    <input type="text" type="datetime-local" class="form-control" id="start_time" name="start_time" placeholder="" value="<?php 
 

   echo $row['start_time'];   
                                                                                                                          
                                                                                                                          
                                                                                                                          
                                                                                                                          ?>" required />
  </div>
        
        
 <div class="form-group" align="right">
    <label for="end_time" align="right">نهاية الاختبار</label>
    <input type="text" type="datetime-local" class="form-control" id="end_time" name="end_time" placeholder="" value="<?php   echo $row['end_time'];   ?>" required />
  </div>        
     <div  class="form-group" align="right" >
			<label for="details">تفاصيل/ملاحظات</label> <br/>
         <textarea  type="text" id="details" name="details"class="form" rows="5" cols="50" value="<?php echo htmlentities($row['ex_description']);?>"></textarea></div>
    
         <?php } ?>   
    
  <div  align="center">
 <button type="submit" name="upload" class="btn btn-default" style="background-color:#6F479F; color:#fff" >تعديل</button> </div>
    
     
   
    
</form>

 </div>
                    
 </div> </div>
 </div>

                 
                 
                 
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