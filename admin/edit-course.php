<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
$id=intval($_GET['id']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(isset($_POST['submit']))
{
$coursecode=$_POST['coursecode'];
$coursename=$_POST['coursename'];
$courseunit=$_POST['courseunit'];
$seatlimit=$_POST['seatlimit'];
$ret=mysqli_query($con,"update course set courseCode='$coursecode',courseName='$coursename',courseUnit='$courseunit',noofSeats='$seatlimit',updationDate='$currentTime' where id='$id'");
if($ret)
{
$_SESSION['msg']="Course Updated Successfully !!";
}
else
{
  $_SESSION['msg']="Error : Course not Updated";
}
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Course</title>
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
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Course  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Course 
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
<?php
$sql=mysqli_query($con,"select * from course where id='$id'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
<p><b>Last Updated at</b> :<?php echo htmlentities($row['updationDate']);?></p>
   <div class="form-group">
    <label for="coursecode">Course Code  </label>
    <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Course Code" value="<?php echo htmlentities($row['courseCode']);?>" required />
  </div>

  <div class="form-group" align="right">
    <label for="first_name" align="right">الاسم الاول</label>
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="" value="<?php echo htmlentities($row['first_name']);?>" required />
  </div>
  
  <div class="form-group" align="right">
    <label for="second_name" align="right">اسم الاب</label>
    <input type="text" class="form-control" id="second_name" name="second_name" placeholder="" value="<?php echo htmlentities($row['first_name']);?>" required />
  </div>
  <div class="form-group" align="right">
    <label for="third_name">اسم الجد</label>
    <input type="text" class="form-control" id="third_name" name="third_name" placeholder="" value="<?php echo htmlentities($row['third_name']);?>" required />
  </div>
  <div class="form-group" align="right">
    <label for="last_name">العائله</label>
    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" value="<?php echo htmlentities($row['last_name']);?>" required />
  </div>

  <div class="form-group" align="right">
    <label for="identity_number">الرقم الوطني</label>
    <input type="text" class="form-control" id="identity_number" name="identity_number" placeholder="" value="<?php echo htmlentities($row['identity_number']);?>" required onBlur="userAvailability()" />
     <span id="user-availability-status1" style="font-size:12px;">
  </div>

<div class="form-group" align="right">
    <label for="gender">الجنس</label> <br>
    <input type="radio"  id="gender" name="gender" value="<?php echo htmlentities($row['gender']);?>"   display="none" checked/>
    <input type="radio"  id="gender" name="gender" value="ذكر" />&nbsp;ذكر
    &nbsp; &nbsp;<input type="radio" id="gender"  value="أنثى"  name="gender" />&nbsp;أنثى 
</div> 

<div class="form-group" align="right">
    <label for="phone">الهاتف</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="" size="10" required />
</div>   

<div class="form-group" align="right">
    <label for="Email">اﻷيميل</label>
    <input type="email" class="form-control" id="Email" name="Email" placeholder="" size="10" required />
</div> 

<div class="form-group" align="right">
    <label for="address">مكان اﻷقامة </label>
    <input type="text" class="form-control" id="address" name="address" placeholder="" required />
</div>

<div  class="form-group" align="right">
    <label for="appointment_year">تاريخ التعيين  </label>&nbsp; &nbsp;
    <input type="date"  class="form-control" id="appointment_year" name="appointment_year" placeholder="" required />
</div>

<div  class="form-group" align="right">
    <label for="date_of_birth">تاريخ الولادة  </label>&nbsp; &nbsp;
    <input type="date"  class="form-control" id="date_of_birth" name="date_of_birth" placeholder="" required />
</div>

<div>
</select>
    <label for="nationality">الجنسية</label>&nbsp; &nbsp;
    <select id="nationality" name="nationality"  >  
      <option value="أردني" selected="selected">
      أردني</option>
      <option value="سوري"> 
      سوري</option>
      <option value="فلسطيني"> 
      فلسطيني</option>
    </select >  
</div> 

<div>
</select>
    <label for="specialization">التخصص</label>&nbsp; &nbsp;
    <select  id="specialization" name="specialization">  
      <option value="رياضيات"  selected="selected">
      رياضيات</option>
      <option value="علوم"> 
      علوم</option>
      <option value="عربي"> 
      عربي</option>
      <option value="تربية أسلامية"> 
       تربية أسلامية</option>
      <option value="أنجليزي"> 
       أنجليزي</option>
      <option value="تربية أجتماعية">  
      تربية أجتماعية</option>
      <option value="تربية رياضية"> 
      تربية رياضية</option>
      <option value="تربية فنية"> 
      تربية فنية</option>
    </select >  
</div> 


<?php } ?>
 <button type="submit" name="submit" class="btn btn-default"><i class=" fa fa-refresh "></i> Update</button>
</form>
                            </div>
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
<?php } ?>
