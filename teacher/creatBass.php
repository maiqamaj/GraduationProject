
<?php
session_start();
include('includes/config.php');



date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

$f = 0;
$f1 = 0;
if(isset($_POST['submit']))
{
  

  $password=$_POST['newpass'];
  
$uppercase = preg_match("/[A-Z]/", $password);
$lowercase = preg_match("/[a-z]/", $password);
$number    = preg_match("/\d/", $password);
$symbol = preg_match("/\W/", $password);
$space = preg_match("/\s/", $password);


if($uppercase &&  $lowercase && $number && strlen($password) >= 8 && $symbol && !$space) {
 $f1 = 1;
 $_SESSION['msg']="تم تغيير كلمة السر بنجاح ";
 $concat=mysqli_query($con,"update teacher set password='".md5($_POST['newpass'])."', updationDate='$currentTime' where id='".$_SESSION['ID']."'");
  
}else{
  $f = 1;
  $_SESSION['msg']="الرجاء ادخال كلمة مرور تتكون من :
  1- ثمانية حروف على الاقل
  2- على الاقل حرف واحد كبير
  3- على الاقل حرف واحد صغير
  4- لا يحتوي على اي فراغ
  5- تحتوي على الاقل رمز واحد

  ";
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
    <title>الطالب | كلمة السر</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpass.value!= document.chngpwd.cnfpass.value)
{
alert("عدم تطابق كلمة السر الجديدة وتأكيدها");
document.chngpwd.cnfpass.focus();
return false;
}
return true;
}
</script>
 <body style="font-family:Courier New; font-size:13px;">
 <div style=" background-color:#6F479F ; color:#fff; font-size:14px ;font-weight: bold;">
                            <img src="jel.png" alt="logo"style="max-height: 100px; padding:5px; padding-right:30px;"/>
            
        جيل الغد للتعليم الألكتروني
      <a href="forgetBass.php"><b><button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
           <div  style="color:#fff; font-size:13px ; padding-right:75px;  background-color:#8967B0 " >
        </div> </div>
    <!-- LOGO HEADER END-->

    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">انشاء كلمة سر جديدة</h1>
                         <hr class="my-5">
                         
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                        انشاء كلمة سر جديدة
                        </div>
                        <?php if($f){

?>
                            <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?></font>
<?php } ?> 
<?php if($f1){

?>
                            <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?></font>
<?php } ?>                    <div class="panel-body">
                       <form name="chngpwd" method="post" onSubmit="return valid();">
   
   <div class="form-group">
    <label for="exampleInputPassword1">كلمة السر الجديدة</label>
    <input type="password" class="form-control" id="exampleInputPassword2" name="newpass" required placeholder="" />
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">تأكيد كلمة السر الجديدة</label>
    <input type="password" class="form-control" id="exampleInputPassword3" name="cnfpass" required placeholder="" />
  </div><div class="form-group"  align="right">
				  <label class="col-md-4 control-label" for="sub"></label>
 
  <button type="submit" name="submit" class="btn btn-default"  style="background-color:#6F479F; color:#fff">انشاء</button>
                      
                           </div>



</form>
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

