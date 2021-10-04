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
    $section_id=$_POST['section_id'];
    $mother_name=$_POST['mother_name'];
    $guardian=$_POST['guardian'];
    $gender=$_POST['gender'];
    $identity_number=$_POST['identity_number'];
    $phone=$_POST['phone'];
    $religion=$_POST['religion'];
    $address=$_POST['address'];
    $date_of_birth=date('Y-m-d', strtotime($_POST['date_of_birth']));
    $nationality=$_POST['nationality'];
    $place_of_birth=$_POST['place_of_birth'];

    
    $vir=true;
    
    $result =mysqli_query($con,"SELECT identity_number FROM student WHERE identity_number='$identity_number' and id <> {$id}");
    $count=mysqli_num_rows($result);
    //var_dump($count);die;
    //$_SESSION['msg']=   null;
    if($count>0)
    {
     $vir=false;
     $_SESSION['msg']=" لم يتم تعديل الطالب الرجاء التأكد من الرقم الوطني لانه موجود مسبقا";
     
    }
    else{
      $reg='/^\d{10}$/';
      if(!preg_match($reg,$identity_number)){
      $_SESSION['msg']="لم يتم تعديل المعلم الرجاء التأكد من ان الرقم الوطني يتكون من 10 ارقام";
      $vir=false;
  }}
    
    
        
       
    if($vir){
        
        $reg='/^\d{10}$/';
        if(preg_match($reg,$phone)){
        $reg1 = '/07[789]\d{7}/';
        if(!preg_match($reg1,$phone)){
            $_SESSION['msg']="لم يتم تعديل الطالب الرجاء التأكد من كتابة رقم الهاتف بالشكل الصحيح";
            $vir=false;
    }}
    else{
        $_SESSION['msg']="لم يتم تعديل الطالب الرجاء التأكد من كتابة رقم الهاتف بالشكل الصحيح";
        $vir=false;
    }
    }
    
    if($vir){
$ret=mysqli_query($con,"update student set section_id=$section_id,first_name='$first_name',second_name='$second_name',third_name='$third_name',last_name='$last_name',identity_number='$identity_number',gender='$gender',phone='$phone',mother_name='$mother_name',address='$address',guardian='$guardian',religion='$religion',date_of_birth='$date_of_birth',nationality='$nationality',place_of_birth='$place_of_birth',updationDate='$currentTime' where id='$id'");
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
    <title>ادمن | بيانات الطالب</title>
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
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">تعديل بيانات الطالب </h1>
                         <hr class="my-5">
                         
                    </div>
                    
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           تعديل بيانات الطالب
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
<?php
$sql=mysqli_query($con,"select * from student where id='$id'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
<p><b>آخر تعديل في</b> :<?php echo htmlentities($row['updationDate']);?></p>

<div class="form-group" align="right">
    <label for="first_name" align="right">الاسم الاول</label>
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="" required value="<?php echo htmlentities($row['first_name']);?>" />
  </div>
  
  <div class="form-group" align="right">
    <label for="second_name" align="right">اسم الاب</label>
    <input type="text" class="form-control" id="second_name" name="second_name" placeholder="" required value="<?php echo htmlentities($row['second_name']);?>"/>
  </div>
  <div class="form-group" align="right">
    <label for="third_name">اسم الجد</label>
    <input type="text" class="form-control" id="third_name" name="third_name" placeholder="" required value="<?php echo htmlentities($row['third_name']);?>"/>
  </div>
  <div class="form-group" align="right">
    <label for="last_name">العائله</label>
    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" required value="<?php echo htmlentities($row['last_name']);?>"/>
  </div>
  <div class="form-group" align="right">
    <label for="mother_name">اسم الام</label>
    <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="" required value="<?php echo htmlentities($row['mother_name']);?>" />
  </div>
  
  <div class="form-group" align="right">
    <label for="guardian">ولي اﻷمر</label>
    <input type="text" class="form-control" id="guardian" name="guardian" placeholder="" required value="<?php echo htmlentities($row['guardian']);?>"/>
  </div>
  
  <div class="form-group" align="right">
    <label for="religion">الديانة </label>
    <input type="text" class="form-control" id="religion" name="religion" placeholder="" required value="<?php echo htmlentities($row['religion']);?>"/>
  </div>

  <div class="form-group" align="right">
  <label for="identity_number"> الرقم الوطني/الرقم التسلسلي</label>
    <input type="text" class="form-control" id="identity_number" name="identity_number" placeholder="" required value="<?php echo htmlentities($row['identity_number']);?>"/>
  </div>
  <?php                                   
$query = "SELECT * FROM course";
$result2 = mysqli_query($con, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{ 
    if($row2[0] == $row['section_id']){
        $slc = "selected";
    }else{
        $slc=null;
    }
    
    $options = $options."<option value= $row2[0]  $slc >$row2[1] &nbsp; $row2[2]</option>";
}

 
?>

<div class="form-group" align="right">
    <label for="section_id">الصف</label>&nbsp; &nbsp;
    <select id="section_id" name="section_id"  class="form-control ">  
            <?php echo $options;?>
        </select>
  
</select>
  </div>
  <!-------------------------------------------------------------------->


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
<div>

</select><div  class="form-group" align="right" >
    <label for="nationality">الجنسية</label>&nbsp; &nbsp;
  <select id="nationality" name="nationality" class="form-control " > 
     
      <option value="أردني"  <?php if($row['nationality'] =="أردني" ) echo "selected" ; ?> >أردني</option>
      <option value="غير أردني"  <?php if($row['nationality'] =="غير أردني") echo "selected" ; ?> > غير أردني</option>
      
    </select >  
</div> 

<div class="form-group" align="right">
    <label for="address">مكان اﻷقامة </label>
    <input type="text" class="form-control" id="address" name="address" placeholder="" value="<?php echo htmlentities($row['address']);?>" required />
</div>

<div class="form-group" align="right">
    <label for="place_of_birth">مكان الولادة </label>
    <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" placeholder="" value="<?php echo htmlentities($row['place_of_birth']);?>" required />
</div>


<div  class="form-group" align="right">
    <label for="date_of_birth">تاريخ الولادة  </label>&nbsp; &nbsp;
    <input type="date"  class="form-control" id="date_of_birth" name="date_of_birth" placeholder="" required value="<?php echo htmlentities($row['date_of_birth']);?>" />
</div>
<!------------------------------------------------>

<?php } ?>  <!-- Button -->
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
