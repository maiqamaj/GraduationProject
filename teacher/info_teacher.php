 <?php
session_start();
error_reporting(0);
include("includes/config.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>المعلومات الشخصيه</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body  style="font-family:Courier New;  margin:0; ">
     <?php include('includes/header.php');?>  
 
  <a href="home.php"> <b> <button style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
  
 <main>
      <!--///////////////؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟////////////////////-->  
                
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">المعلومات الشخصية</h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>
                        <!-- /.panel-heading -->
      <div class="col-md-12">
                    <!--    Bordered Table  -->
                   <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                                   
                        <div class="panel-heading">
                       
                        
                                <table class="table">
                                  <thead>
                                     
                                             <tr>
                                             <th style="text-align:center;"> الاسم الاول</th>
                                             <th style="text-align:center;">الاسم الثاني</th>
                                             <th style="text-align:center;">الاسم الثالث</th>
                                             <th style="text-align:center;">الاسم الرابع</th>
                                             
                                         
                         
                                             </tr>
                                    </thead>
						</div>
					</div>
                                    <tbody>
<?php
$s=$_SESSION['login'];

$sql=mysqli_query($con,"select * from teacher WHERE id='$s'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>

  
                                        <tr style="background-color:#fff;">
                                           
                                           
                                            <td style="text-align:center"><?php echo htmlentities($row['first_name']);?></td>
                                            <td style="text-align:center"> <?php echo htmlentities($row['second_name']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['third_name']);?></td>
											 <td style="text-align:center"><?php echo htmlentities($row['last_name']);?></td>
                                            
                                            
                                        </tr>
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
									<thead>
                                     <br>
                                        <tr>
                                             <th style="text-align:center"> الرقم التعريفي</th>
                                             <th style="text-align:center">الرقم الوطني</th>
                                         
                                             <th style="text-align:center">الجنس</th>
                                             <th style="text-align:center">العنوان</th>
                                             
                                         
                                    

                                        </tr>
                                    </thead> 
                                    <tbody>
<?php
$s=$_SESSION['login'];
$sql=mysqli_query($con,"select * from teacher WHERE id='$s'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr style="background-color:#fff;">
                                           
                                           
                                            <td style="text-align:center"><?php echo htmlentities($row['id']);?></td>
                                            <td style="text-align:center"> <?php echo htmlentities($row['identity_number']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['gender']);?></td>
											 <td style="text-align:center"><?php echo htmlentities($row['address']);?></td>
                                            
                                            
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
      <thead>
                                     
                                        <tr>
                                             <th style="text-align:center"> الجنسيه</th>
                                             <th style="text-align:center">التخصص</th>
                                         
                                             <th style="text-align:center">تاريخ التعيين</th>
                                             <th style="text-align:center">تاريخ الميلاد</th>
                                             
                                         
                                    

                                        </tr>
                                    </thead> 
                                    <tbody>
<?php
$s=$_SESSION['login'];
$sql=mysqli_query($con,"select * from teacher WHERE id='$s'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr style="background-color:#fff;">
                                           
                                           
                                            <td style="text-align:center"><?php echo htmlentities($row['nationality']);?></td>
                                            <td style="text-align:center"> <?php echo htmlentities($row['specialization']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['appointment_year']);?></td>
											 <td style="text-align:center"><?php echo htmlentities($row['date_of_birth']);?></td>
                                            
                                            
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
									     
                                  
      <thead>
                                     
                                        <tr>
                                             <th style="text-align:center">رقم الموبايل</th>
                                             <th style="text-align:center">الايميل</th>
                                         
                                             
                                         
                                    

                                        </tr>
                                    </thead> 
                                    <tbody>
<?php
$s=$_SESSION['login'];
$sql=mysqli_query($con,"select * from teacher WHERE id='$s'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr style="background-color:#fff;">
                                           
                                           
                                            <td style="text-align:center"><?php echo htmlentities($row['phone']);?></td>
                                            <td style="text-align:center"> <?php echo htmlentities($row['Email']);?></td>
                                            
                                            
                                            
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                   
									<tr style="background-color:#fff;">
										<td style="text-align:center;"><a href="edit_teacher_phone.php?id=<?php echo $row['id']?>">
										<button class="btn btn-primary"><i class="fa fa-edit "></i> تعديل</button> </a></td>
										<td style="text-align:center"><a href="edit_teacher_email.php?id=<?php echo $row['id']?>">
										<button class="btn btn-primary"><i class="fa fa-edit "></i> تعديل</button> </a></td></tr>
			</tbody>
                                </table>
                            </div>
                        </div>
        </div>
        </div>
        </div>
                     <!--  End  Bordered Table  -->
                </div> </div>
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