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
if(isset($_POST['submit']))
{ 
 
    $question=$_POST['question'];
    $choice_A=$_POST['choice_A'];
    $choice_B=$_POST['choice_B'];
    $choice_C=$_POST['choice_C'];
    $choice_D=$_POST['choice_D'];
    $correctAnswer=$_POST['correctAnswer'];
    $mark=$_POST['mark'];
   
 
    if($question=='' or $choice_A=='' or $choice_B=='' or $choice_C=='' or $choice_D=='' or $mark==''){
      $_SESSION['msg']="لم يتم اضافة السؤال الرجاء كتابة جميع المعلومات بالشكل الصحيح";

    }else{
$t=$_SESSION['login'];
$exam_id=$_SESSION['exam_id'];
$sql="INSERT INTO exam_question_tbl(exam_id,exam_question,exam_ch1,exam_ch2,exam_ch3,exam_ch4,exam_answer,eq_mark) VALUES('$exam_id','$question','$choice_A','$choice_B','$choice_C','$choice_D','$correctAnswer','$mark')";

$ret=mysqli_query($con,$sql) or die(mysqli_error($con));
if($ret)
{
$_SESSION['msg']="تم اضافة السؤال بنجاح !!!";
}
else
{
    $_SESSION['msg']="لم يتم الاضافة بنجاح";
  }}

$total_mark=0;
$numOfqustion=0;
$q1 =mysqli_query($con,"SELECT * FROM exam_question_tbl WHERE exam_id = '$exam_id'");
if (mysqli_num_rows($q1) > 0) {
    while ($row=mysqli_fetch_assoc($q1)) {
        $total_mark=$total_mark+$row['eq_mark'];
        $numOfqustion=$numOfqustion+1;
    }}
$update = "UPDATE exam_tbl SET ex_mark='$total_mark' , ex_questlimit_display= '$numOfqustion' WHERE exam_id = '$exam_id'";
$results=mysqli_query($con,$update ) or die(mysqli_error($con));
}
	
if(isset($_GET['del']))
      {     $de="DELETE FROM exam_question_tbl where id = '".$_GET['id']."'";
            $rt=mysqli_query($con,$de);
       if($rt)
       {  $_SESSION['dm']="تم حذف السؤال بنجاح";}
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
             
              
 <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">الاسئلة المضافة</h1>
                         <hr class="my-5" >
                         <div  align="left">
 <button class="btn btn-default" style="color:#6F479F; background-color:#fff; font-size:15px; font-weight: bold; "><a href= "addqustion.php?id=<?php echo $row[exam_id]?>" > اضافة سؤال</a></button> 
                       </div>
                       <br>
                          <font color="green" align="center"><?php echo htmlentities($_SESSION['dm']);?><?php echo htmlentities($_SESSION['dm']="");?></font>

                    </div>
                </div>

   
                  <div class="panel panel-default">
                             

                        <div class="panel-heading">
                            <?php
                             $exam_id=$_SESSION['exam_id']; 

                           $ex= mysqli_query($con,"select * from exam_tbl where exam_id = '$exam_id'");
                            $exam= mysqli_fetch_array($ex);
                            $s=$exam['sub_id'];
                            $sub= mysqli_query($con,"select * from subject where id = '$s'");
                            $subject= mysqli_fetch_array($sub);          
                                echo htmlentities("المادة: "),($subject['subjectName']),"&nbsp; &nbsp;عنوان الاختبار: ",$exam['ex_title'],"&nbsp;&nbsp;العلامة الكلية:&nbsp;",$exam['ex_mark'],"&nbsp;&nbsp;عدد الاسئلة:&nbsp;",$exam['ex_questlimit_display'];?>
                        </div>
  
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                  <thead>
                                    <tbody>
                                        <tr>
                                             <th style="text-align:center">#</th>
                                          
                                             <th style="text-align:center">السؤال</th>
                                             <th style="text-align:center">الخيار الاول</th>
                                             <th style="text-align:center"> الخيار الثاني</th>
                                                 <th style="text-align:center">الخيار الثالث</th>
                                                <th style="text-align:center">الخيار الرابع</th>
                                                  <th style="text-align:center">الاجابة الصحيحة</th>
                                                  <th style="text-align:center">علامة السؤال </th>
                                                  <th style="text-align:center">الإجراءات</th>
                                        
                                        
                                     <?php     $cnt=1; 
                                        $exam_id=$_SESSION['exam_id']; 
                                         $sql1=mysqli_query($con,"SELECT DISTINCT * FROM `exam_question_tbl` where exam_id = '$exam_id' ");
                                       while(  $row1=mysqli_fetch_array($sql1))
                                       {
      
 


                                           
                                        ?>
                                        <tr>
                                           
                                            
                                            <td style="text-align:center"><?php echo $cnt;?></td>
                                         
                                          
                                      <td style="text-align:center"><?php echo htmlentities($row1['exam_question']);?></td>
                                      <td style="text-align:center"><?php echo htmlentities($row1['exam_ch1']);?></td>
                                      <td style="text-align:center"><?php echo htmlentities($row1['exam_ch2']);?></td>
                                              <td style="text-align:center"><?php echo htmlentities($row1['exam_ch3']);?></td>
                                         
                                                 <td style="text-align:center"><?php echo htmlentities($row1['exam_ch4']);?></td>
                                                 <td style="text-align:center"><?php echo htmlentities($row1['exam_answer']);?></td>
                                                 <td style="text-align:center"><?php echo htmlentities($row1['eq_mark']);?></td>
                                              <td style="text-align:center">
                                                 
                                            <a href="edit-qustion.php?id=<?php echo $row1['eqt_id']?>">
                                                <button class="btn btn-primary" ><i class="fa fa-edit " ></i> تعديل</button> </a>                                         
  <a href="homework.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('هل أنت متأكد من حذف السؤال')">
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