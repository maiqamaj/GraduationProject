
<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}

?>

<?php
	
	
	if(ISSET($_POST['save'])){
		$file_name = $_FILES['video']['name'];
		$file_temp = $_FILES['video']['tmp_name'];
		$file_size = $_FILES['video']['size'];
		$class=$_POST['class'];
$t=$_SESSION['login'];
		if($file_size < 100000000000000000){
			$file = explode('.', $file_name);
			$end = end($file);
			$allowed_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4');
			if(in_array($end, $allowed_ext)){
				$name = $file_name;
                
				$location = '../corsatstudent/'.$name.".".$end;
				
				if(move_uploaded_file($file_temp, $location)){
					mysqli_query($con, "INSERT INTO `video_lesson`(teacher,class,video_name ,location) VALUES('$t','$class','$name', '$location')") or die(mysqli_error());
					echo "<script>alert('تم اضافة الفيديو ')</script>";
				}
			    }else{
				echo "<script>alert('  صيغة الفيديو خاطئ')</script>";
				echo "<script>window.location = 'addLesson.php'</script>";
			      }
		       }else{
			   echo "<script>alert(' حجم الفيديو كبير للغاية')</script>";
			   echo "<script>window.location = 'addLesson.php'</script>";
		         }
		
	}

	if(isset($_GET['del']))
      {     $de="DELETE FROM video_lesson where id = '".$_GET['id']."'";
            $rt=mysqli_query($con,$de);
       if($rt)
       {  $_SESSION['dm']="تم حذف الفيديو بنجاح";}
      }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>دروس تقويه للطالب</title>
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
<body>
<?php include('includes/header.php');?>
<a href="home.php"><b><button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
    <!-- LOGO HEADER END-->
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">                       
                    <div class="col-md-12">

                        <h1 class="page-head-line">دروس تقويه للطالب  </h1>

                    </div>
                </div>


                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">

                        
<font color="green" align="center">
<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>

    <div class="panel-body">

    <form  method="post" enctype="multipart/form-data">
    <div  class="form-group" align="right" >


			<label for="class">الصف</label> 
            <select  id="class" name="class"  class="form-control">                          
   <?php
           $saa=mysqli_query($con,"select DISTINCT class from `addtable` where teacher='".$_SESSION['login']."' ");
                         while($da= mysqli_fetch_array($saa))
            {       
                          $class1=$da['class'];
                          $cl= mysqli_query($con,"select * from course where id = '$class1'");
                          $class= mysqli_fetch_array($cl);
   ?>
<option value="" disabled selected hidden>اختر الصف </option>
            <option  value="<?php echo $class[0];?>">
                <?php echo $class[1]," ",$class[2]; ?>
            </option>
            <?php   }?>
        </select> 

		<br>

		<div class="form-group" align="right">
 <h3  style="text-align:center" >
		<button type="button"   style="text-align:right"  class="btn btn-primary" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> اضافة فيديو</button>
		<br /><br />
		
		<hr style="border-top:3px solid #ccc;"/>
	  
		
 
	</div>	
	</div>
    <div class="modal fade" id="form_modal" aria-hidden="true">
		<div class="modal-dialog">
		<form action="lesson_teacher.php" method="POST" enctype="multipart/form-data">

				<div class="modal-content">
					<div class="modal-body">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label>اختر اسم الملف </label>
								<input type="file" name="video" class="form-control-file"/>
							</div>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> اغلاق</button>
						<button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> حفظ</button>
					</div></div>	</form>		
                    </div></div>







   

 </div>
                    
</div> </div>

</div>


<div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">الفيديوهات المضافة</h1>
                         <hr class="my-5" >
                          <font color="green" align="center"><?php echo htmlentities($_SESSION['dm']);?><?php echo htmlentities($_SESSION['dm']="");?></font>

                    </div>
                </div>

				<?php        
                 $saa=mysqli_query($con,"select DISTINCT class from `addtable` where teacher='".$_SESSION['login']."' ");
                            while($da= mysqli_fetch_array($saa))
    
{       
  
                       ?>  
					    <div class="panel panel-default">
                             

                        <div class="panel-heading">

						<?php
                           $class1=$da['class'];
                           $cl= mysqli_query($con,"select * from course where id = '$class1'");
                           $class= mysqli_fetch_array($cl);
                                         
                                echo htmlentities($class['className'])," ",$class['numOfSection'];?>
                        </div>



                        
  
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                  <thead>
                                    <tbody>
                                        <tr>
                                             <th style="text-align:center">#</th>

                                             <th style="text-align:center">اسم الفيديو</th>
                                             <th style="text-align:center">الفيديو</th>
                                             <th style="text-align:center">الإجراءات</th>
                                        
                                              
                                     <?php  
									    $cnt=1; 
                                        
										$sql=mysqli_query($con,"SELECT DISTINCT * FROM `video_lesson` where class='".$da['class']."' 
										AND teacher='".$_SESSION['login']."' ");
                                       
									  while(  $row=mysqli_fetch_array($sql))
									  {
											
$class1=$row['class'];

$sec=mysqli_query($con,"select numOfSection from course where id ='".$class1."'");
$section= mysqli_fetch_array($sec);



										  
									   ?>
 <tr>
                                           
                                            
									 <td style="text-align:center"><?php echo $cnt;?></td>										 
									 <td style="text-align:center"><?php echo htmlentities($row['video_name']);?></td>

									 <td style="text-align:center">
				                     <video width="20%" height="80" controls>
					                 <source src="<?php echo $row['location']?>">
				                    </video>                       	
									</td>

									 
									
												
									 <td style="text-align:center">
	                                       
                                           <a href="addLesson.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('هل أنت متأكد من حذف الفيديو')">
										   <button class="btn btn-danger" style="background-color:#DC143C">حذف</button>
                                            </a>

										   </td>
						  


            
										   </tbody>     <?php $cnt++;} ?>
    </table>
     </div>
      </div>    
           <hr>       
                

        <?php        }              ?>
  
     
  
 
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











 