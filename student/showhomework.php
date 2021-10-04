<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
    
    
    
    
$id=intval($_GET['id']);
if(isset($_POST['submit']))
{
    $class=$_POST['class'];
    $subject=$_POST['subject'];
    $start_time=$_POST['start_time'];
    $end_time=$_POST['end_time'];
    $details=$_POST['details'];
   

    $vat=true;
  
 if($vat){            
$ret=mysqli_query($con,"update homework set class='$class',subject='$subject',start_time='$start_time',end_time='$end_time',details='$details' where id='$id'");
if($ret)
{
$_SESSION['msg']="تم التعديل بنجاح";
}
else
{
  $_SESSION['msg']=" خطأ : لم يتم تعديل ";
}
}}}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>عرض الواجبات</title>
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
<a href="homework.php"> <b> <button  style="position: absolute;
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
الواجب                        </div>
        
                        <div class="panel-body">
    <form  method="post" enctype="multipart/form-data">
    <div  class="form-group" align="right" >
      
<?php
        $sql=mysqli_query($con,"select * from homework where id='$id'");
while($row=mysqli_fetch_array($sql))
     
{           
   
 $class1=$row['subject'];
    $cl= mysqli_query($con,"select * from subject where id = '$class1'");
                          $class= mysqli_fetch_array($cl);
  
?>     
 <label for="start_time" align="right">الملف</label>
  <div  class="form" style="background-color: #f5f5f5; height: 300px;">
 <?php   
    
    $final_file='../homework/'.$row['file'];
  if ($row['type']=='image/png')
  echo "<img src='".$final_file."' style=' width: 100%; height: 100%; 
    object-fit: contain;'>";
     else 
     echo "<iframe src='".$row['file']."' style=' width: 100%; height: 100%; 
    object-fit: contain;'></iframe>";

 
    ?>
                            

  </div>
 
        
         <div class="form-group" align="right">
    <label for="start_time" align="right">المادة</label>
    <input type="text" type="datetime-local" class="form-control" id="subject" name="subject" placeholder="" value="<?php echo htmlentities($class['subjectName']);?>" readonly />
  </div>
        
 <div class="form-group" align="right">
    <label for="start_time" align="right">بداية التسليم</label>
    <input type="text" type="datetime-local" class="form-control" id="start_time" name="start_time" placeholder="" value="<?php 
     $x=substr($row['start_time'], 0, 11);
   $x1=substr($row['start_time'],  10,10);
   $X=substr($row['end_time'], 0, 11);
   $X1=substr($row['end_time'],  10,10);
                                       
    
    
     echo 'التاريخ :',$x,'&nbsp;&nbsp;','الساعة :',$x1;            ?>" readonly />
  </div>
        
        
 <div class="form-group" align="right">
    <label for="end_time" align="right">نهاية التسليم</label>
    <input type="text" type="datetime-local" class="form-control" id="end_time" name="end_time" placeholder="" value="<?php  echo 'التاريخ :',$X,'&nbsp;&nbsp;','الساعة :',$X1;?>" readonly/>
  </div>        
      


  <?php } ?>   
        
        
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