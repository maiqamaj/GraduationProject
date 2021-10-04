<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
    
    
    
    
$id=intval($_GET['id']);

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>عرض الاختبارات</title>
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
الاختبارات                        </div>
        
                        <div class="panel-body">
    <form  method="post" enctype="multipart/form-data" action="start-exam.php" >
    <div  class="form-group" align="right" >
      
<?php
        $id=intval($_GET['id']);

        $check = 0;
         $cl= mysqli_query($con,"select start_time,end_time from exam_tbl where exam_id = '$id' ");
                            $nnnn= mysqli_fetch_array($cl);
  
      $start_date = date("Y-m-d H:i", strtotime($nnnn[0]));
      $end_date = date("Y-m-d H:i", strtotime($nnnn[1]));
     date_default_timezone_set('Asia/Amman');
    $current_datetime = date("Y-m-d H:i", strtotime('0 hours'));
    echo "<center>".'الوقت الان هو :'.$current_datetime.'</center>';
    
 

if($current_datetime > $end_date){
       echo "<p style='text-align:center; color:red; '>انتهى موعد الامتحان </p>"; 
       $check = 1;
}else{ 
    
    
    
    echo "<p style='text-align:center;'> موعد امتحانك يبدأ  $start_date وينتهي  $end_date </p>"; 

    if ($current_datetime >= $start_date && $current_datetime < $end_date)
           {
     

    
     ?>
 <input name="exam" type="hidden" id="exam" value="<?php echo intval($_GET['id']);?>">   
   
   
   <div  align="center">
  <button type="submit" name="save"  class="btn btn-default" style="background-color:#6F479F; color:#fff" >بدء الاختبار</button> </div>
  
   
    <?php  
    
}
    else 
        
    { ?>    
        
        
   <input name="exam" type="hidden" id="exam" value="<?php echo intval($_GET['id']) ?>">   
   
   
  <div  align="center">
 <button type="submit" name="save" class="btn btn-default" disabled style="background-color:#6F479F; color:#fff" >بدء الاختبار</button> </div>
 
        
        
    <?php }}} ?>
                      </div> 
                            
                            
</form>
        <?php
        if ($check){
           ?>
            <form method="post" action="showResultExamStudent.php" > 
                                                   
                                                   <div  align="center">
                                                   <input name="examID" type="hidden" id="examID" value="<?php echo intval($_GET['id']); ?>">
                                                   <input name="studentID" type="hidden" id="studentID" value="<?php echo $_SESSION['login']; ?>">
<button type="submit" name="submit" class="btn btn-default" style="background-color:#008000; color:#fff" >عرض النتيجة </button> </div>
    </form>


     <?php   }
        


        ?>
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