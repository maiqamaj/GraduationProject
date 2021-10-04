<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> معلومات الطالب </title>
  <!-- facebook/github Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">

</head>
<div class="container-fluid">
<?php


$sql =mysqli_query($con,"SELECT s.section_id,s.id,CONCAT(first_name,' ',second_name,' ',last_name) as full_name,date_of_birth,place_of_birth,nationality,address,religion,phone,mother_name,guardian,identity_number,gender,c.className FROM student as s
inner join course as c on c.id  = s.section_id");
$students = mysqli_fetch_all($sql,MYSQLI_ASSOC);


$sql =mysqli_query($con,"SELECT * from course ");
$classes = mysqli_fetch_all($sql,MYSQLI_ASSOC);




//var_dump($classes);die;


?>    
    <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>المعلم | التواصل</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
</div>
<body>
<?php include('includes/header.php');?>
<a href="home.php"> <b> <button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>

    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              
               
            
        <!-- CONTENT-WRAPPER SECTION END-->
                            
    
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">معلومات الطالب</h1>
                    </div>
                </div>
				
               
             <div class="col-md-12">
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <form method="post" action="teacher_studentinfo.php"> 
                    <label for="class">الصف</label> <select  id="class" name="class" required="">   
        <option value="" disabled selected hidden>أختر الصف/الشعبة</option>
   <?php
           $saa=mysqli_query($con,"select DISTINCT class from `addtable` where teacher='".$_SESSION['login']."' ");
                         while($da= mysqli_fetch_array($saa))
            {       
                          $class1=$da['class'];
                          $cl= mysqli_query($con,"select * from course where id = '$class1'");
                          $class= mysqli_fetch_array($cl);
   ?>     
     
        
            <option  value="<?php echo $class[0];?>">
                <?php echo $class[1]," ",$class[2]; ?>
            </option>
            <?php   }?>
        </select>
       
       <button type="submit" name="submit" class="btn btn-default" style="background-color:#6F479F; color:#fff;" >عرض</button>
                                                   </div>
       </form>




<?php
			if(isset($_POST['submit']))
            { 
             
                $class=$_POST['class'];
               
            
               
             
            
            
            ?>	   


                    <div class="panel panel-default">
                    <div class="panel-heading">
                       
                      

                            <table class="table" id="student-table">
                               <thead>
                                     
                                             <tr>
											 <th style="text-align:center;">#</th>
                                             <th style="text-align:center;"> الرقم التعريفي</th>
											 <th style="text-align:center;">الرقم الوطني</th>
                                             <th style="text-align:center;">الاسم</th>
                                             <th style="text-align:center;">اسم الام</th>
                                             <th style="text-align:center;">اسم ولي الامر</th>
											 <th style="text-align:center;">الجنس</th>
											 <th style="text-align:center;">الهاتف</th>
											 <th style="text-align:center;">الديانه</th>
											 <th style="text-align:center;">العنوان</th>
											 <th style="text-align:center;">الجنسيه</th>
											 <th style="text-align:center;">تاريخ الولاده</th>
											 <th style="text-align:center;">مكان الولاده</th>
											 
                                             
                                         
                         
                                             </tr>
                                    </thead>
									</div>
									</div>
									<tbody style="background-color:#fff;">
                                    <?php     $cnt=1; 
                                            
                                        
                                            $sql1=mysqli_query($con,"SELECT * FROM `student` where section_id = '$class' ");
                                          while(  $row1=mysqli_fetch_array($sql1))
                                          {
                                          
                                           ?>
                                           <tr>
                                              
                                               
                                               <td style="text-align:center"><?php echo $cnt;?></td>
                                            
                                               <td style="text-align:center"><?php echo htmlentities($row1['id']);?></td>
                                               <td style="text-align:center"><?php echo htmlentities($row1['identity_number']);?></td>
                                          
                                         <td style="text-align:center"><?php 
                                           
                                              echo htmlentities($row1['first_name'])," ",$row1['second_name']," ",$row1['third_name']," ",$row1['last_name'];
                                              
 
                                         
                                         
                                         ?></td>


                                      
                                           
                                          
                                             <td style="text-align:center"><?php echo htmlentities($row1['mother_name']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row1['guardian']);?></td>
                                          
                                  
                                            <td style="text-align:center"><?php echo htmlentities($row1['gender']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row1['phone']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row1['religion']);?></td>
                                            
                                            <td style="text-align:center"><?php echo htmlentities($row1['address']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row1['nationality']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row1['date_of_birth']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row1['place_of_birth']);?></td>
                                          
												  




                                </tr>
                                
                                <?php $cnt++;}}?>
								 </tbody>
                            </table>
                           
                                </div>
								</div>
                        </div>
                   
                     <!--  End  Bordered Table  -->
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
