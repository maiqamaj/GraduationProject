<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
    
    
    
    
$id=intval($_GET['id']);
if(isset($_POST['submit']))
{
    $teacher=$_POST['teacher'];
    $class=$_POST['class'];
    $subject=$_POST['subject'];
    $vat=true;
  
 if($vat){            
$ret=mysqli_query($con,"update addtable set teacher=$teacher,class='$class',subject='$subject' where id='$id'");
if($ret)
{
$_SESSION['msg']="تم التعديل بنجاح";
}
else
{
  $_SESSION['msg']=" خطأ : لم يتم تعديل ";
}
}}}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ادمن | تعديل جدول دراسي</title>
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
                        <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">تعديل جدول دراسي  </h1>
                           <hr class="my-5">
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading" >
                           تعديل جدول
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <?php
$sql=mysqli_query($con,"select * from addtable where id='$id'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>

  <?php                                   
$query = "SELECT * FROM teacher";
$result2 = mysqli_query($con, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{ 
    if($row2[0] == $row['teacher']){
        $slc = "selected";
    }else{
        $slc=null;
    }
    
    $options = $options."<option value= $row2[0]  $slc >$row2[2] $row2[3] $row2[4] $row2[5]</option>";
}

 
?>

<div class="form-group" align="right">
    <label for="teacher" >المعلم</label>&nbsp; &nbsp;
    <select id="teacher" name="teacher"  class="form-control" >  
            <?php echo $options;?>
        </select>
  
</select>
  </div>

<!------------------------------------------------>

<?php } ?>                                 
                           
                           
                           
                           
<?php
$sql=mysqli_query($con,"select * from addtable where id='$id'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>

  <?php                                   
$query = "SELECT * FROM course";
$result2 = mysqli_query($con, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{ 
    if($row2[0] == $row['class']){
        $slc = "selected";
    }else{
        $slc=null;
    }
    
    $options = $options."<option value= $row2[0]  $slc >$row2[1] &nbsp; $row2[2]</option>";
}

 
?>

<div class="form-group" align="right">
    <label for="class">الصف</label>&nbsp; &nbsp;
    <select id="class" name="class"  class="form-control" >  
            <?php echo $options;?>
        </select>
  
</select>
  </div>

<!------------------------------------------------>

<?php } ?>
                            
                            
                            
                            
                            
<?php
$sql=mysqli_query($con,"select * from addtable where id='$id'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>

  <?php                                   
$query = "SELECT * FROM subject";
$result2 = mysqli_query($con, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{ 
    if($row2[0] == $row['subject']){
        $slc = "selected";
    }else{
        $slc=null;
    }
    
    $options = $options."<option value= $row2[0]  $slc >$row2[1]</option>";
}

 
?>

<div class="form-group" align="right">
    <label for="subject">المادة</label>&nbsp; &nbsp;
    <select id="subject" name="subject"  class="form-control" >  
            <?php echo $options;?>
        </select>
  
</select>
  </div>

<!------------------------------------------------>

<?php } ?>
                            
            
                            
                            
                            
                            
 <button type="submit" name="submit" class="btn btn-default"  style="background-color:#6F479F; color:#fff"> تعديل</button>
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

