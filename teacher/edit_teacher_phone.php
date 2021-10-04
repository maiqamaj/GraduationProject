<?php
session_start();
include('includes/config.php');

$id=intval($_GET['id']);
date_default_timezone_set('Asia/Amman');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(isset($_POST['submit']))
{
    $s=$_SESSION['login'];
    $phone=$_POST['phone'];
    
    $id = $_GET['id'];
    
    $vir=true;
    
   
   
    
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
$ret=mysqli_query($con,"update teacher set phone='$phone',updationDate='$currentTime' where id='$s'");
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
    <title>معلم | تعديل الهاتف</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

 <body style="font-family:Courier New; font-size:13px;">
<?php include('includes/header.php');?>
<a href="info_teacher.php"> <b> <button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
    <!-- LOGO HEADER END-->

    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  
   <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">تعديل هاتف المعلم</h1>
                         <hr class="my-5">
                         
                    </div>
                    
                    
                    
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           تعديل هاتف المعلم
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
<?php
$s=$_SESSION['login'];
$sql=mysqli_query($con,"select * from teacher where id='$s'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
<p><b>آخر تعديل في</b> :<?php echo htmlentities($row['updationDate']);?></p>
   
<div class="form-group" align="right">
    <label for="phone">الهاتف</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="" size="10" value="<?php echo htmlentities($row['phone']);?>" required />
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

