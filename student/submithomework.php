<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}

?>


<?php
$id=intval($_GET['id']);
if(isset($_POST['submit']))
{ 
 $file = $_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 	date_default_timezone_set('Asia/Amman');

  $n = date("Y-m-d H:i:sA", strtotime('0 hours'));
    
$t=$_SESSION['login'];
 $sql=mysqli_query($con,"select * from homework where id='$id'");
 $row=mysqli_fetch_array($sql);
 $teacher=$row['teacher'];
 $class=$row['class'];
 $subject=$row['subject'];
 $details=$_POST['details'];
    
 /* new file size in KB */
 $new_size = $file_size/1024;  
 /* new file size in KB */
 /* make file name in lower case */
 $new_file_name = strtolower($file);
 /* make file name in lower case */
 $final_file=str_replace(' ','-',$new_file_name);
    
  $submithomework='../homework/'.$final_file;
    #$final_file='homework/'.$final_file;
 if(move_uploaded_file($file_loc,$submithomework))
 {
  $sql="INSERT INTO submithomework(teacher,class,idstudent,subject,homework,submithomework,type,size,details,sumbitbate) VALUES('$teacher','$class','$t','$subject','$id','$submithomework','$file_type','$new_size','$details','$n')";

  
$ret=mysqli_query($con,$sql);
if($ret)
{
$_SESSION['msg']="تم تسليم الواجب بنجاح !!!";
}
     else {
      $_SESSION['msg']="الواجب موجود مسبقاً !!!";   
     }

	}
}  
if(isset($_GET['del']))
      {     $de="DELETE FROM submithomework where homework = '".$id."'";
            $rt=mysqli_query($con,$de);
       if($rt)
       {  $_SESSION['dm']="تم حذف الواجب بنجاح";}
      }
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>تسليم الواجبات</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

    <style>
    
    .form {
  text-align:right;
  display: block;
  width: 100%;
  height: 100px;

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
         <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
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
 <label for="start_time" align="right">ملف الواجب</label>
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
 
        
  

  <?php } ?>   
         
                      </div> 
                        <div  class="form-group" align="right" >
			<label for="class">اختر الحل</label> 
         <input type="file" name="file" class="form-control"/> </div>
             
      
         <div  class="form-group" align="right" >
			<label for="details">هل لديك اي ملاحظات على الواجب</label> <br/>
         <textarea  type="text" id="details" name="details"class="form" rows="5" cols="50"></textarea></div>
    
                          
              <button  type="submit" name="submit" class="btn btn-default"  style="background-color:#6F479F; color:#fff; "> تسليم</button>    
</form>
                            
                           
                            </div>
                    </div>
                  
                </div>
         
            </div>





        </div>
    </div>
   
 <div class="content-wrapper">
        <div class="container">
               <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">حل الواجب</h1>
                         <hr class="my-5" >
                         
                    </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
حل الواجب                        </div>
        
                        <div class="panel-body">
    <form  method="post" enctype="multipart/form-data">
    <div  class="form-group" align="right" >
      
<?php
        $sql=mysqli_query($con,"select * from submithomework where homework='$id'");
while($row=mysqli_fetch_array($sql))
     
{               $clas=$row['homework'];
    $cl= mysqli_query($con,"select * from homework where id = '$clas'");
                          $CL= mysqli_fetch_array($cl);

  
?>   

   
                 
    <label for="start_time" align="right">الحل </label>

  <font color="green" align="center"><?php echo htmlentities($_SESSION['dm']);?><?php echo htmlentities($_SESSION['dm']="");?></font>
                        <div  class="form" style="background-color: #f5f5f5; height: 300px;">
              <?php          
             $final_file='../homework/'.$row['submithomework'];
  if ($row['type']=='image/png')
  echo "<img src='".$final_file."' style=' width: 100%; height: 100%; 
    object-fit: contain;'>";
     else 
     echo "<iframe src='".$final_file."' style=' width: 100%; height: 100%; 
    object-fit: contain;'></iframe>";
 ?>
                            
  </div>

     <div  class="form-group" align="right" >
			<label for="details">تفاصيل/ملاحظات</label> <br/>
         <input  type="text" id="details" name="details"class="form" readonly value="<?php echo htmlentities($row['details']);?>" /></div>  
        
          <div  class="form-group" align="right" >
			<label for="details">وقت التسليم</label> <br/>
         <input  type="text" id="details" name="details"class="form" readonly value="<?php
 
  $x=substr($row['sumbitbate'], 0, 11);
   $x1=substr($row['sumbitbate'],10,10);
   echo 'التاريخ :',$x,'&nbsp;&nbsp;','الساعة :',$x1;    ?>" /></div>  


  <?php } ?>   
        
        
                      </div> 
                            
                            
</form>
              <a href="submithomework.php?id=<?php echo $CL['id']?>&del=delete" onClick="return confirm('هل أنت متأكد من حذف الحل')">
                                            <button class="btn btn-danger" style="background-color:#DC143C">حذف</button>
</a>               
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