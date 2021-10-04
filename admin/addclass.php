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

$classname=$_POST['classname'];
$numofsection=$_POST['numofsection'];
$ret=mysqli_query($con,"insert into course(className,numOfSection) values('$classname','$numofsection')");
if($ret)
{
$_SESSION['msg']="تم انشاء الصف بنجاح !!";
}
else
{
  $_SESSION['msg']="منشأ سابقا !!!!";
}
}
if(isset($_GET['del']))
      {
              mysqli_query($con,"delete from course where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="تم حذف الصف !!";
      }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ادمن | الصفوف</title>
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
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;"> اضافه صف جديد</h1>
                         <hr class="my-5">
                         
                    </div>
                    
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading" align="right">
                           اضافه صف
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group" align="right">
    <label for="coursecode" align="right">اسم الصف</label>
	<select class="form-control" id="classname" name="classname" required> 
    <option value="" disabled selected hidden>اختر الصف </option>	
	<option value="الصف الاول" name="classname" >الصف الاول</option>  
	<option value="الصف الثاني" name="classname">الصف الثاني</option>  
	<option value="الصف الثالث"name="classname">الصف الثالث</option>  
	<option value="الصف الرابع" name="classname">الصف الرابع</option>  
	<option value="الصف الخامس"name="classname">الصف الخامس</option>  
	<option value="الصف السادس" name="classname">الصف السادس</option>  
	<option value="الصف السابع" name="classname">الصف السابع</option>  
	<option value="الصف الثامن" name="classname">الصف الثامن</option>  
	<option value="الصف التاسع" name="classname">الصف التاسع</option>  
	<option value="الصف العاشر"name="classname">الصف العاشر</option>  
	
	</select>  
  
   
  </div>

 <div class="form-group" align="right">
    <label for="coursename" align="right">الشعبه</label>
   <select type="text" class="form-control" id="numofsection" name="numofsection" placeholder="" required> 
    <option value="" disabled selected hidden>اختر الشعبه </option>	
	<option value="أ" name="classname" >أ</option>  
	<option value="ب" name="classname">ب</option>  
	<option value="ج"name="classname">ج</option>  
	<option value="د" name="classname">د</option>  

   </select>  	
  </div>
                              <!-- Button -->
				<div class="form-group"  align="right">
				  <label class="col-md-4 control-label" for="sub"></label>
				  
 <button type="submit" name="submit" class="btn btn-default"   style="background-color:#6F479F; color:#fff">اضافه</button>
  </div>
				
                            </form>
     </div>
                            </div>
                    </div>
                  
                </div><br><br>
              
              

                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            اداره الصفوف
                        </div>
                        <!-- /.panel-heading -->
      <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                  <thead>
                                      
                                        <tr>
                                             <th style="text-align:center">#</th>
                                             <th style="text-align:center">الصف</th>
                                         
                                             <th style="text-align:center">الشعبه</th>
                                             <th style="text-align:center">تاريخ الأنشاء</th>
                                             <th style="text-align:center">الاجراءات</th>
                                         
                                    

                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select * from course");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td style="text-align:center"><?php echo $cnt;?></td>
                                           
                                            <td style="text-align:center"><?php echo htmlentities($row['className']);?></td>
                                            <td style="text-align:center"> <?php echo htmlentities($row['numOfSection']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['creationDate']);?></td>
                                            <td style="text-align:center">
                                                                                  
  <a href="addclass.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('هل أنت متأكد أنك تريد حذف؟')">
                                            <button class="btn btn-danger"style="background-color:#DC143C" >حذف</button>
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
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
