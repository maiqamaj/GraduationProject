<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{


 

if(isset($_POST['sub']))
{    

 $teacher = $_POST['teacher'];
 $course = $_POST['course'];
 $subject = $_POST['subject'];

 
    
 $sss = "INSERT INTO addtable (teacher,class,subject) VALUES ('$teacher','$course','$subject')";
$rt=mysqli_query($con,$sss);
 if($rt){
$_SESSION['ms']="تمت اضافه جدول بنجاح";}
 else {$_SESSION['ms']="منشأ مسبقاً يرجى التأكد ";}   
}
if(isset($_GET['del']))
      {     $de="DELETE FROM addtable where id = '".$_GET['id']."'";
            $rt=mysqli_query($con,$de);
       if($rt)
       {  $_SESSION['dm']="تم حذف الجدول بنجاح";}
      }

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ادمن | الجدول الدراسي</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

 <body style="font-family:Courier New; font-size:13px;">
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
    <!---------------------------------------------------------------------------------------------------->
   
                
         

      <!--------------------------------------------------------------------------------------->
    
    <!-- MENU SECTION END-->
             
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">انشاء جدول جديد</h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           جدول دراسي
                        </div>
                             <font color="green" align="center"><?php echo htmlentities($_SESSION['ms']);?><?php echo htmlentities($_SESSION['ms']="");?></font>

                        <div class="panel-body">
                       <form  method= "post" >
   <!--////////////////////////////////////-->
                           
 
 <?php $query = "SELECT * FROM `teacher`"; $result2 = mysqli_query($con, $query); $options = ""; ?>
    <div class="form-group" align="right">
			<label  for="teacher">المعلم</label> 
     
		<select  id="teacher" name="teacher"  class="form-control">
    <option  value="" disabled selected hidden>اختر المعلم</option>
            <?php while($row1 = mysqli_fetch_array($result2)):;?>

     <option  value="<?php echo $row1[0];?>">
      <?php echo $row1[2]; echo ' '; echo $row1[3]; echo ' '; echo $row1[4]; echo ' '; echo $row1[5];?>
            
            </option>
            <?php endwhile;?>
        </select> 
		</div>		  
   
    <!--////////////////////////////////////--> 

                           
   <?php $query = "SELECT * FROM `course`"; $result2 = mysqli_query($con, $query); $options = ""; ?>

         <div  class="form-group" align="right" >
			<label for="course">الصف-الشعبة</label> 
		
		<select  id="course" name="course"  class="form-control">
    <option  value="" disabled selected hidden>اختر الصف</option>
            <?php while($row1 = mysqli_fetch_array($result2)):;?>
            <option  value="<?php echo $row1[0];?>">
                <?php echo $row1[1]; echo " "; echo $row1[2];?>
            </option>
            <?php endwhile;?>
        </select> 
		</div>		  
 
                    
  
                     
                                                   
    <!--////////////////////////////////////-->
       <?php $query = "SELECT * FROM `subject`"; $result2 = mysqli_query($con, $query); $options = ""; ?>

         <div  class="form-group" align="right">
			<label for="subject">المادة</label> 
		
		<select  id="subject" name="subject"  class="form-control">
    <option  value="" disabled selected hidden>اختر المادة</option>
            <?php while($row1 = mysqli_fetch_array($result2)):;?>
            <option  value="<?php echo $row1[0];?>">
                <?php echo $row1[1];?>
            </option>
            <?php endwhile;?>
        </select> 
		</div>		  
  
                       
                            <!-- Button -->
				<div class="form-group"  align="right">
				  <label class="col-md-4 control-label" for="sub"></label>
				  
					<button id="sub" name="sub" class="btn btn-success"  style="background-color:#6F479F; color:#fff">اضافه</button>
				  </div>
				
                            </form>
     </div>
                            </div>
                    </div>
                  
                </div>
                </div>
                </div>
                </div>


    <!--///////////////؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟////////////////////-->    
  <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                               
                        <div class="panel-heading">
                        الجداول الدارسية
                        </div>
                          <font color="green" align="center"><?php echo htmlentities($_SESSION['dm']);?><?php echo htmlentities($_SESSION['dm']="");?></font>

                          
                        <!-- /.panel-heading -->
                      
  <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                  <thead>
                                      
                                        <tr>
                                             <th style="text-align:center">#</th>
                                             <th style="text-align:center">المعلم</th>
                                             <th style="text-align:center">الصف</th>
                                             <th style="text-align:center">الشعبة</th>
                                         
                                             <th style="text-align:center">المادة</th>
                                            
                                       
                                             <th style="text-align:center">الإجراءت</th>
                                    

                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$cnt=1;
$sql=mysqli_query($con,"SELECT * FROM `addtable` ");
while($row=mysqli_fetch_array($sql))
    
{
     $class1=$row['class'];
  $cl= mysqli_query($con,"select className,numOfSection from course where id = '$class1'");
  $class= mysqli_fetch_array($cl);
 
    
    
      $subject=$row['subject'];    
      $sec=mysqli_query($con,"select subjectName from subject where id = '$subject'");
  $subject= mysqli_fetch_array($sec);
      

     $teacher=$row['teacher'];    
      $sec=mysqli_query($con,"select first_name,second_name,third_name,last_name from teacher where id = '$teacher'");
  $teacher= mysqli_fetch_array($sec);
    
    

?>
  
                                        <tr>
                                            
                                            <td style="text-align:center"><?php echo $cnt;?></td>
                                            <td style="text-align:center"><?php echo htmlentities($teacher['first_name']);echo " ";  echo htmlentities($teacher['second_name']);echo " ";  echo htmlentities($teacher['third_name']); echo " ";  echo htmlentities($teacher['last_name']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($class['className']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($class['numOfSection']);?></td>
                                     
                                            <td style="text-align:center"><?php echo htmlentities($subject['subjectName']);?></td>
                                            
                                               <td style="text-align:center">
                                            <a href="edit-table.php?id=<?php echo $row['id']?>">
                                                <button class="btn btn-primary"><i class="fa fa-edit "></i> تعديل</button> </a>                                         
  <a href="addtabel.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('هل أنت متأكد من حذف جدول')">
                                            <button class="btn btn-danger" style="background-color:#DC143C">حذف</button>
</a>

                                            </td>
                                  
                                        </tbody>
                             

                                          
<?php 
$cnt++;
} ?>
   </table>
                            </div>
                        </div>
                                        
                                
                    </div>
                     <!--  End  Bordered Table  -->
                </div>
            </div>





        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>



</body>
</html>
<?php } ?>