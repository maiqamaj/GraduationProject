<?php
session_start();
include('includes/config.php');


?>

<?php
 $f=0;
if(isset($_POST['upload']))
{  
    $ID=$_POST['ID'];
    $ID2=$_POST['ID2'];
    $q1 =mysqli_query($con,"SELECT * FROM student WHERE id = '$ID' AND identity_number = '$ID2'");
$count=mysqli_num_rows($q1);
if($count>0)
{   
    $row=mysqli_fetch_assoc($q1);
    $extra="creatBass.php?id=<?php echo $row[id]?>";
    
    $host=$_SERVER['HTTP_HOST'];
    $_SESSION['ID']=$row[id];
    $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location:http://$host$uri/$extra");
    exit();
    }
    else
    {   $f=1;
        $_SESSION['msg']="تاكد من كتابة الرقم التعريفي والوطني بشكلهم الصحيح";
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
    <title>كلمة سر</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

    <style>
    
    .form {
  text-align:right;
  display: block;
  width: 100%;
  height: 200px;

  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
       -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
          transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.form:focus {
  border-color: #66afe9;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
          box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
}
.form::-moz-placeholder {
  color: #999;
  opacity: 1;
}
.form:-ms-input-placeholder {
  color: #999;
}
.form::-webkit-input-placeholder {
  color: #999;
}
.form[disabled],
.form[readonly],
fieldset[disabled] .form {
  cursor: not-allowed;
  background-color: #eee;
  opacity: 1;
}
textarea.form {
  height: auto;
}
    
    
    </style>
<body  style="font-family:Courier New;  margin:0; ">

<div style=" background-color:#6F479F ; color:#fff; font-size:14px ;font-weight: bold;">
                            <img src="jel.png" alt="logo"style="max-height: 100px; padding:5px; padding-right:30px;"/>
            
        جيل الغد للتعليم الألكتروني
      <input type="button" value="العودة" onclick="history.back()" style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">
           <div  style="color:#fff; font-size:13px ; padding-right:75px;  background-color:#8967B0 " >
           </div>
           </div>
      <!--------------------------------------------------------------------------------------->
    
    <!-- MENU SECTION END-->
             
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">كلمة السر  </h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
 هل نسيت كلمة السر؟                        </div>
 <?php if($f){

 ?>
                             <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?></font>
<?php } ?>

                        <div class="panel-body">
    <form  method="post" enctype="multipart/form-data" action="forgetBass.php">
    <div  class="form-group" align="right" >
        
        
        
        
          <div class="form-group">
            <label>ادخل الرقم التعريفي الخاص بك  </label>
            <input type="number" name="ID" id="ID" class="form-control" placeholder="الرقم التعريفي " required="" >
          </div>
          <div class="form-group">
            <label>  ادخل الرقم الوطني </label>
            <input type="number" name="ID2" id="ID2" class="form-control" placeholder=" الرقم الوطني" maxlength='10' required="">
          </div>

    
  <div  align="center">
 <button type="submit" name="upload" class="btn btn-default" style="background-color:#6F479F; color:#fff" >انشاء</button> </div>
    
     
   
    
</form>

 </div>
                    
 </div> </div>
 </div>

 
       
          
       
      
                 <!--    Bordered Table  -->
                 
                 
                         
                 
                 
                 
                 
                 
                 
                 
                 
                                           </div></div>
                                           </div></div>
        
         </main>
      
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