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
	 <a href="home.php"> <b> <button  style="position: absolute; 
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

$sql=mysqli_query($con,"select * from student WHERE id='$s'");
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
                                         
                                             <th style="text-align:center">اسم الام</th>
                                             <th style="text-align:center">اسم ولي الامر</th>
                                             
                                         
                                    

                                        </tr>
                                    </thead> 
                                    <tbody>
<?php
$s=$_SESSION['login'];
$sql=mysqli_query($con,"select * from student WHERE id='$s'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr style="background-color:#fff;">
                                           
                                           
                                            <td style="text-align:center"><?php echo htmlentities($row['id']);?></td>
                                            <td style="text-align:center"> <?php echo htmlentities($row['identity_number']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['mother_name']);?></td>
											 <td style="text-align:center"><?php echo htmlentities($row['guardian']);?></td>
                                            
                                            
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
      <thead>
                                     
                                        <tr>
                                             <th style="text-align:center"> الجنس</th>
                                             <th style="text-align:center">الديانه</th>
                                         
                                             <th style="text-align:center">العنوان</th>
                                             <th style="text-align:center">الجنسيه</th>
                                             
                                         
                                    

                                        </tr>
                                    </thead> 
                                    <tbody>
<?php
$s=$_SESSION['login'];
$sql=mysqli_query($con,"select * from student WHERE id='$s'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr style="background-color:#fff;">
                                           
                                           
                                            <td style="text-align:center"><?php echo htmlentities($row['gender']);?></td>
                                            <td style="text-align:center"> <?php echo htmlentities($row['religion']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['address']);?></td>
											 <td style="text-align:center"><?php echo htmlentities($row['nationality']);?></td>
                                            
                                            
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
									     
                                  
      <thead>
                                     
                                        <tr>
										     <th style="text-align:center">تاريخ الولاده</th>
                                             <th style="text-align:center">مكان الولاده</th>
                                             <th style="text-align:center">رقم الموبايل</th>
                                             
                                         
                                             
                                         
                                    

                                        </tr>
                                    </thead> 
                                    <tbody>
<?php
$s=$_SESSION['login'];
$sql=mysqli_query($con,"select * from student WHERE id='$s'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr style="background-color:#fff;">
                                           
                                            <td style="text-align:center"><?php echo htmlentities($row['date_of_birth']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['place_of_birth']);?></td>
                                            <td style="text-align:center"> <?php echo htmlentities($row['phone']);?></td>
                                            
                                            
                                            
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                   
									<tr >
										<td style="text-align:center;"></td>
										<td style="text-align:center;"></td>
										<td style="text-align:center; background-color:#fff;""><a href="edit_student_phone.php?id=<?php echo $row['id']?>">
										<button class="btn btn-primary"><i class="fa fa-edit "></i> تعديل</button> </a></td></tr>
			</tbody>
                                </table>
                            </div>
                        </div>
        </div>
                     <!--  End  Bordered Table  -->
                </div>
				</body>
</html>