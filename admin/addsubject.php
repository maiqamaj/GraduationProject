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

$subjectname=$_POST['subjectname'];
$ret=mysqli_query($con,"insert into subject(subjectName) values('$subjectname')");
if($ret)
{
$_SESSION['msg']="تم انشاء الماده بنجاح !!!";
}
else
{
  $_SESSION['msg']="منشأ سابقا !!!!";
}
}
if(isset($_GET['del']))
      {
              mysqli_query($con,"delete from subject where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="تم حذف الماده";
      }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ادمن | المواد</title>
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
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">اضافة مادة جديدة</h1>
                         <hr class="my-5">
                         
                    </div>
                    
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading" align="right">
                           اضافه ماده
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group" align="right">
    <label for="coursecode" align="right">اسم الماده</label>
	<select class="form-control" id="subjectname" name="subjectname" required> 
    <option value="" disabled selected hidden>اختر الماده </option>	
	<option value="الرياضيات" name="subjectname" >الرياضيات</option>  
	<option value="العلوم" name="subjectname">العلوم</option>  
	<option value="التربيه الاسلاميه"name="subjectname">التربيه الاسلاميه</option>  
	<option value="اللغه العربيه" name="subjectname">اللغه العربيه</option>  
	<option value="اللغه الانجليزيه"name="subjectname">اللغه الانجليزيه</option>  
	<option value="الاجتماعيات" name="subjectname">الاجتماعيات</option>  
	<option value="اللغه الفرنسيه" name="subjectname">اللغه الفرنسيه</option>  
	<option value="الفيزياء" name="subjectname">الفيزياء</option>  
	<option value="الكيمياء" name="subjectname">الكيمياء</option>  
	<option value="الاحياء"name="subjectname">الاحياء</option>  
	<option value="علوم الارض"name="subjectname">علوم الارض</option> 
	<option value="تاريخ"name="subjectname">تاريخ</option> 
	<option value="وطنيه"name="subjectname">وطنيه</option> 
	<option value="الجغرافيا"name="subjectname">الجغرافيا</option> 
	<option value="الماليه"name="subjectname">الماليه</option> 
	<option value="الفن"name="subjectname">الفن</option> 
	
	</select>  
  
   
  </div>
     
                            <!-- Button -->
				<div class="form-group"  align="right">
				  <label class="col-md-4 control-label" for="sub"></label>
				  
  
 <button type="submit" name="submit" class="btn btn-default"  style="background-color:#6F479F; color:#fff">اضافه</button>
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
                            اداره المواد
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead >
                                        <tr style="text_align:right">
                                            <th style="text-align:center">#</th>
                                            <th style="text-align:center">اسم الماده</th>
											<th style="text-align:center">تاريخ الانشاء</th>
											<th style="text-align:center">الاجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select * from subject");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td style="text-align:center"><?php echo $cnt;?></td>
                                           
                                            <td style="text-align:center"><?php echo htmlentities($row['subjectName']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['cretionData']);?></td>
                                            <td style="text-align:center">
                                                                                  
  <a href="addsubject.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('هل أنت متأكد أنك تريد حذف؟')">
                                            <button class="btn btn-danger" style="background-color:#DC143C">حذف</button>
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
