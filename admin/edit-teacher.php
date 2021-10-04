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
    $first_name=$_POST['first_name'];
    $second_name=$_POST['second_name'];
    $third_name=$_POST['third_name'];
    $last_name=$_POST['last_name'];
    $identity_number=$_POST['identity_number'];
    $gender=$_POST['gender'];
    $phone=$_POST['phone'];
    $Email=$_POST['Email'];
    $address=$_POST['address'];
    $appointment_year=date('Y-m-d', strtotime($_POST['appointment_year']));
    $date_of_birth=date('Y-m-d', strtotime($_POST['date_of_birth']));
    $nationality=$_POST['nationality'];
    $specialization=$_POST['specialization'];

    $id = $_GET['id'];
    
    $vir=true;
    
    $result =mysqli_query($con,"SELECT identity_number FROM teacher WHERE identity_number='$identity_number' and id <> {$id}");
    $count=mysqli_num_rows($result);
    //var_dump($count);die;
    //$_SESSION['msg']=   null;
    if($count>0)
    {
     $vir=false;
     $_SESSION['msg']=" لم يتم تعديل المعلم الرجاء التأكد من الرقم الوطني لانه موجود مسبقا";
     
    }
    else{
      $reg='/^\d{10}$/';
      if(!preg_match($reg,$identity_number)){
      $_SESSION['msg']="لم يتم تعديل المعلم الرجاء التأكد من ان الرقم الوطني يتكون من 10 ارقام";
      $vir=false;
  }}
    
   // var_dump($_SESSION);die;
        
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg']="لم يتم تعديل المعلم الرجاء التأكد من كتابة اﻷيميل بالشكل الصحيح";
            $vir=false;
        }
    if($vir){
        
        $reg='/^\d{10}$/';
        if(preg_match($reg,$phone)){
        $reg1 = '/07[789]\d{7}/';
        if(!preg_match($reg1,$phone)){
            $_SESSION['msg']="لم يتم تعديل المعلم الرجاء التأكد من كتابة رقم الهاتف بالشكل الصحيح";
            $vir=false;
    }}
    else{
        $_SESSION['msg']="لم يتم تعديل المعلم الرجاء التأكد من كتابة رقم الهاتف بالشكل الصحيح";
        $vir=false;
    }
    }
    
    if($vir){
$ret=mysqli_query($con,"update teacher set first_name='$first_name',second_name='$second_name',third_name='$third_name',last_name='$last_name',identity_number='$identity_number',gender='$gender',phone='$phone',Email='$Email',address='$address',appointment_year='$appointment_year',date_of_birth='$date_of_birth',nationality='$nationality',specialization='$specialization',updationDate='$currentTime' where id='$id'");
if($ret)
{
$_SESSION['msg']="تم التعديل بنجاح";
}
else
{
  $_SESSION['msg']=" خطأ : لم يتم تعديل المعلم بنجاح الرجاء التأكد من الرقم الوطني بأنه 10 أرقام";
}
}}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ادمن | تعديل بيانات المعلم</title>
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
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">تعديل بيانات المعلم</h1>
                         <hr class="my-5">
                         
                    </div>
                    
                    
                    
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           تعديل بيانات المعلم
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
<?php
$sql=mysqli_query($con,"select * from teacher where id='$id'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
<p><b>آخر تعديل في</b> :<?php echo htmlentities($row['updationDate']);?></p>
   
  <div class="form-group" align="right">
    <label for="first_name" align="right">الاسم الاول</label>
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="" value="<?php echo htmlentities($row['first_name']);?>" required />
  </div>
  
  <div class="form-group" align="right">
    <label for="second_name" align="right">اسم الاب</label>
    <input type="text" class="form-control" id="second_name" name="second_name" placeholder="" value="<?php echo htmlentities($row['second_name']);?>" required />
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
  <label for="identity_number"> الرقم الوطني/الرقم التسلسلي</label>
    <input type="text" class="form-control" id="identity_number" name="identity_number" placeholder="" value="<?php echo htmlentities($row['identity_number']);?>" required />
  </div>

<div class="form-group" align="right">
    <label for="gender"> الجنس &nbsp;</label><br>
 <?php $gender=htmlentities($row['gender']); ?>
   
    <input type="radio"  id="gender" name="gender" value="ذكر"  <?php  if($gender =='ذكر') echo "checked"; ?>   />&nbsp;ذكر
    &nbsp; &nbsp;<input type="radio" id="gender"  value="أنثى"  name="gender" <?php  if($gender =='أنثى') echo "checked"; ?>   />&nbsp;أنثى 
</div> 

<div class="form-group" align="right">
    <label for="phone">الهاتف</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="" size="10" value="<?php echo htmlentities($row['phone']);?>" required />
</div>   

<div class="form-group" align="right">
    <label for="Email">اﻷيميل</label>
    <input type="email" class="form-control" id="Email" name="Email" placeholder="" size="10" value="<?php echo htmlentities($row['Email']);?>" required />
</div> 

<div class="form-group" align="right">
    <label for="address">مكان اﻷقامة </label>
    <input type="text" class="form-control" id="address" name="address" placeholder="" value="<?php echo htmlentities($row['address']);?>" required />
</div>

<div  class="form-group" align="right">
    <label for="appointment_year">تاريخ التعيين  </label>&nbsp; &nbsp;
    <input type="date"  class="form-control" id="appointment_year" name="appointment_year" placeholder="" value="<?php echo htmlentities($row['appointment_year']);?>" required />
</div>

<div  class="form-group" align="right">
    <label for="date_of_birth">تاريخ الولادة  </label>&nbsp; &nbsp;
    <input type="date"  class="form-control" id="date_of_birth" name="date_of_birth" placeholder="" value="<?php echo htmlentities($row['date_of_birth']);?>"  required />
</div>


</select><div  class="form-group" align="right" >
    <label for="nationality">الجنسية</label>&nbsp; &nbsp;
  <select id="nationality" name="nationality" class="form-control " > 
     
      <option value="أردني"  <?php if($row['nationality'] =="أردني" ) echo "selected" ; ?> >أردني</option>
      <option value="غير أردني"  <?php if($row['nationality'] =="غير أردني") echo "selected" ; ?> > غير أردني</option>
      
    </select >  
</div> 


   


<?php                                   
$query = "SELECT * FROM `subject` ";
$result2 = mysqli_query($con, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{ 
    if($row2[0] == $row['specialization']){
        $slc = "selected";
    }else{
        $slc=null;
    }
    
    $options = $options."<option value= $row2[0]  $slc >$row2[1] </option>";
}

 
?>

<div class="form-group" align="right">
    <label for="specialization">التخصص</label>&nbsp; &nbsp;
    <select id="specialization" name="specialization"  class="form-control ">  
            <?php echo $options;?>
        </select>
  
</select>
  </div>

<?php } ?>
                                 <!-- Button -->
				<div class="form-group"  align="right">
				  <label class="col-md-4 control-label" for="sub"></label>
 <button type="submit" name="submit" class="btn btn-default" style="background-color:#6F479F; color:#fff"> تعديل</button>
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
