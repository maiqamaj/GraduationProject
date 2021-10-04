<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{   
$id=intval($_GET['id']);
if(ISSET($_POST['save'])){
		$file_name = $_FILES['video']['name'];
		$file_temp = $_FILES['video']['tmp_name'];
		$file_size = $_FILES['video']['size'];
		$class=$_POST['class'];
		$subject=$_POST['subject'];
		$details=$_POST['details'];
		//$teacher=$_POST['teacher'];
		$t=$_SESSION['login'];
       if($file_size < 50000000){
			$file = explode('.', $file_name);
			$end = end($file);
			$allowed_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4');
			if(in_array($end, $allowed_ext)){
				$name = $file_name;
				$location = '../lesson/'.$name.".".$end;
				
				if(move_uploaded_file($file_temp, $location)){
					mysqli_query($con, "INSERT INTO `lesson`(teacher,class,subject,video_name ,location,details) VALUES('$t','$class','$subject','$name', '$location','$details')") or die(mysqli_error());
					echo "<script>alert('تم اضافة الفيديو ')</script>";
				}
			    }else{
				echo "<script>alert('  صيغة الفيديو خاطئ')</script>";
				echo "<script>window.location = 'lesson_teacher.php'</script>";
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
    <title>عرض الدرس</title>
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
<a href="lesson_teacher.php"> <b> <button  style="position: absolute;
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
الدرس                        </div>
        
                        <div class="panel-body">
    <form  method="post" enctype="multipart/form-data">
    <div  class="form-group" align="right" >
      
<?php
        $sql=mysqli_query($con,"select * from lesson where id='$id'");
while($row=mysqli_fetch_array($sql))
     
{               $clas=$row['class'];
    $cl= mysqli_query($con,"select * from course where id = '$clas'");
                          $CL= mysqli_fetch_array($cl);
 $class1=$row['subject'];
    $cl= mysqli_query($con,"select * from subject where id = '$class1'");
                          $class= mysqli_fetch_array($cl);
  
?>   
        
         
            
                   
  
             
                 
                 
    <label for="start_time" align="right">الدرس</label>
                    
  

                        <div  class="form" style="background-color: #f5f5f5; height: 300px;">
              <?php
                     
 

          
  //if ($row['type']=='image/png')
    $final_file='../lesson/'.$v=$row['video'];?>
	<video width="100%" height="100%" controls>
	<source src="<?php echo $row['location']?>">
	</video>
     

 

    
                            

  </div>


 
        
        

          <div class="form-group" align="right">
    <label for="start_time" align="right">الصف</label>
    <input type="text" type="datetime-local" class="form-control" id="class" name="class" placeholder="" value="<?php echo htmlentities($CL['className'])," ",$CL['numOfSection'];?>" readonly />
  </div>
        
         <div class="form-group" align="right">
    <label for="start_time" align="right">المادة</label>
    <input type="text" type="datetime-local" class="form-control" id="subject" name="subject" placeholder="" value="<?php echo htmlentities($class['subjectName']);?>" readonly />
  </div>
   <div  class="form-group" align="right" >
			<label for="details">تفاصيل/ملاحظات</label> <br/>
         <input  type="text" id="details" name="details"class="form" readonly value="<?php echo htmlentities($row['details']);?>" /></div>      
  

  <?php } ?>   
        
        
                      </div> 
                            
                            
</form>
                           
                            </div>
                    </div>
                  
                </div>
                
            </div>





        </div>
    </div>
 
  
       
                

  
     
  
 
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