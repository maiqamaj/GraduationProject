<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{


$password=md5("Student@123");
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

$result =mysqli_query($con,"SELECT identity_number FROM student WHERE identity_number='$identity_number'");
$count=mysqli_num_rows($result);
if($count>0)
{   
 $vir=false;
 $_SESSION['msg']=" لم يتم أضافة الطالب الرجاء التأكد من الرقم الوطني لانه موجود مسبقا";
 
}
else{
    $reg3='/^\d{10}$/';
	if(!preg_match($reg3,$identity_number)){
		$_SESSION['msg']="لم يتم أضافة الطالب الرجاء التأكد من ان الرقم الوطني يتكون من 10 ارقام";
		$vir=false;
}}


if($vir){
    
	$reg='/^\d{10}$/';
	if(preg_match($reg,$phone)){
	$reg1 = '/07[789]\d{7}/';
	if(!preg_match($reg1,$phone)){
		$_SESSION['msg']="لم يتم أضافة الطالب الرجاء التأكد من كتابة رقم الهاتف بالشكل الصحيح";
		$vir=false;
}}
else{
    $_SESSION['msg']="لم يتم أضافة الطالب الرجاء التأكد من كتابة رقم الهاتف بالشكل الصحيح";
    $vir=false;
}
}

if($vir){
    $ret=mysqli_query($con,"insert into student(password,section_id,first_name,second_name,third_name,last_name,mother_name,guardian,identity_number,gender,religion,address,place_of_birth,date_of_birth,nationality,phone) values('$password','$section_id','$first_name','$second_name','$third_name','$last_name','$mother_name','$guardian','$identity_number','$gender','$religion','$address','$place_of_birth','$date_of_birth','$nationality','$phone')") or die(mysqli_error($con));;
 


if($ret)
{
$_SESSION['msg']="تم أضافة الطالب بنجاح";
}
else
{
  $_SESSION['msg']=" خطأ : لم يتم أضافة الطالب بنجاح الرجاء التأكد من الرقم الوطني بأنه 10 أرقام";
}
}}
if(isset($_GET['del']))
      {
              mysqli_query($con,"delete from student where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="تم حذف الطالب";
      }

      if(isset($_GET['password']))
      {
        $password="Student@123";
        $newpass=md5($password);
              mysqli_query($con,"update student set password='$newpass' where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="تمت أعادة تعيين كلمة السر وهي Student@123";
      } 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ادمن | الطالب</title>
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
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">اضافه طالب جديد</h1>
                         <hr class="my-5">
                         
                    </div>
                    
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading" align="right">
                        اضافه طالب
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">


 <div class="form-group" align="right">
    <label for="first_name" align="right">الاسم الاول</label>
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="" required />
  </div>
  
  <div class="form-group" align="right">
    <label for="second_name" align="right">اسم الاب</label>
    <input type="text" class="form-control" id="second_name" name="second_name" placeholder="" required />
  </div>
  <div class="form-group" align="right">
    <label for="third_name">اسم الجد</label>
    <input type="text" class="form-control" id="third_name" name="third_name" placeholder="" required />
  </div>
  <div class="form-group" align="right">
    <label for="last_name">العائله</label>
    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" required />
  </div>
  <div class="form-group" align="right">
    <label for="mother_name">اسم الام</label>
    <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="" required />
  </div>
  
  <div class="form-group" align="right">
    <label for="guardian">ولي اﻷمر</label>
    <input type="text" class="form-control" id="guardian" name="guardian" placeholder="" required />
  </div>
  
  <div class="form-group" align="right">
    <label for="religion">الديانة </label>
    <input type="text" class="form-control" id="religion" name="religion" placeholder=""required />
  </div>

  <div class="form-group" align="right">
    <label for="identity_number"> الرقم الوطني/الرقم التسلسلي</label>
    <input type="text" class="form-control" id="identity_number" name="identity_number" placeholder="" required />
  </div>

  <?php                                   
$query = "SELECT * FROM course";
$result2 = mysqli_query($con, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{ 
    $options = $options."<option value= $row2[0]>$row2[1] &nbsp; $row2[2]</option>";
}
?>

<div class="form-group" align="right">
    <label for="section_id">الصف</label>&nbsp; &nbsp;
    <select id="section_id" name="section_id"  class="form-control ">  
    <option  value="" disabled selected hidden>اختر الصف</option>
            <?php echo $options;?>
        </select>
  
</select>
  </div>


  

<div class="form-group" align="right">
    <label for="gender">الجنس</label> <br>
    <input type="radio"  id="gender" name="gender" value="ذكر" />&nbsp;ذكر
    &nbsp; &nbsp;<input type="radio" id="gender"  value="أنثى"  name="gender" />&nbsp;أنثى 
</div> 

<div class="form-group" align="right">
    <label for="phone">الهاتف</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="" size="10" required />
</div>   
<div>
</select>
                           <div  class="form-group" align="right" >
    <label for="nationality">الجنسية</label>&nbsp; &nbsp;
    <select id="nationality" name="nationality"  class="form-control "> 
    <option value="" selected="selected">
      اختر الجنسية</option> 
      <option value="أردني" >
      أردني</option>
      <option value="غيرأردني"> 
      غير أردني</option>
     
    </select >  
</div>  </div>

<div class="form-group" align="right">
    <label for="address">مكان اﻷقامة </label>
    <input type="text" class="form-control" id="address" name="address" placeholder="" required />
</div>

<div class="form-group" align="right">
    <label for="place_of_birth">مكان الولادة </label>
    <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" placeholder="" required />
</div>


<div  class="form-group" align="right">
    <label for="date_of_birth">تاريخ الولادة  </label>&nbsp; &nbsp;
    <input type="date"  class="form-control" id="date_of_birth" name="date_of_birth" placeholder="" required />
</div>
 <!-- Button -->
				<div class="form-group"  align="right">
				  <label class="col-md-4 control-label" for="sub"></label>

<button type="submit" name="submit" id="submit" class="btn btn-default"   style="background-color:#6F479F; color:#fff">حفظ</button>
</form>
                            </div>
                            </div>
                    </div>
                    </div>
                  
                </div><br><br>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        إدارة بيانات الطالب
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                             <th style="text-align:center">#</th>
                                             <th style="text-align:center"> الرقم التعريفي</th>
                                       
                                             <th style="text-align:center">الصف</th>
                                             <th style="text-align:center">الشعبة</th>
                                             <th style="text-align:center">الاسم الاول</th>
                                             <th style="text-align:center">اسم الاب</th>
                                             <th style="text-align:center">اسم الجد</th>
                                             <th style="text-align:center">العائله</th>
                                             <th style="text-align:center">اسم الام</th>
                                             <th style="text-align:center">ولي اﻷمر</th>
                                             <th style="text-align:center">الديانة</th>
                                             <th style="text-align:center">الرقم الوطني</th>
                                             <th style="text-align:center">الجنس</th>
                                             <th style="text-align:center">الهاتف</th>
                                             <th style="text-align:center">الجنسية</th>
                                             <th style="text-align:center">مكان اﻷقامة</th>
                                             <th style="text-align:center">تاريخ الولادة</th>
                                             <th style="text-align:center">مكان الولادة</th>
                                             <th style="text-align:center">تاريخ اﻷنشاء</th>
                                             <th style="text-align:center">اﻷجراء</th>

                                        </tr>
                                    </thead>
                                    <tbody>

<?php
$sql=mysqli_query($con,"select * from student");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{ $class1=$row['section_id'];
  $cl= mysqli_query($con,"select className from course where id = '$class1'");
  $class= mysqli_fetch_array($cl);
  $sec=mysqli_query($con,"select numOfSection from course where id = '$class1'");
  $section= mysqli_fetch_array($sec);
?>

                                        <tr>
                                            <td style="text-align:center"><?php echo $cnt;?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['id']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($class['className']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($section['numOfSection']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['first_name']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['second_name']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['third_name']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['last_name']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['mother_name']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['guardian']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['religion']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['identity_number']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['gender']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['phone']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['nationality']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['address']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['date_of_birth']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['place_of_birth']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['creationDate']);?></td>
                                    
                                            <td style="text-align:center">
                                            <a href="edit-student.php?id=<?php echo $row['id']?>">
<button class="btn btn-primary"><i class="fa fa-edit "></i> تعديل</button> </a>                                        
  <a href="admin_student_page.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('هل أنت متأكد من حذف الطالب؟')">
                                            <button class="btn btn-danger"style="background-color:#DC143C">حذف</button>
</a>
</a>
<a href="admin_student_page.php?id=<?php echo $row['id']?>&password=update" onClick="return confirm('هل أنت متأكد من أعادة تعيين كلمة السر؟')">
<button type="submit" name="submit" id="submit" class="btn btn-default">أعادة تعيين كلمة السر</button>
</a>
                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
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