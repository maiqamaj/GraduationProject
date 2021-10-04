<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}

?>
<?php

// php select option value from database
mysqli_set_charset($con, 'utf8');
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>العلامات</title>
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

<?php include('includes/header.php');?>
<a href="home.php"> <b> <button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
      <!--------------------------------------------------------------------------------------->
    
    <!-- MENU SECTION END-->
             
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">
                         العلامات</h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
 اضافة العلامات                        </div>
                           
                        <div class="panel-body">
    <form  method="post" enctype="multipart/form-data" action="markstd.php">
    <div  class="form-group" align="right" >
        
        
        
        
			<label for="class">الصف</label> <select  id="class" name="class"  class="form-control" required="">   
        <option  value="" disabled selected hidden>اختر الصف</option>
   <?php
           $saa=mysqli_query($con,"select DISTINCT class from `addtable` where teacher='".$_SESSION['login']."' ");
                         while($da= mysqli_fetch_array($saa))
            {       
                          $class1=$da['class'];
                          $cl= mysqli_query($con,"select * from course where id = '$class1'");
                          $class= mysqli_fetch_array($cl);
   ?>     
     
        
            <option  value="<?php echo $class[0];?>">
                <?php echo $class[1]," ",$class[2]; ?>
            </option>
            <?php   }?>
        </select>
        
        
           
			<label for="subject">المادة</label> <select  id="subject" name="subject"  class="form-control" required="">   
         <option  value="" disabled selected hidden>اختر المادة</option>
   <?php
           $saa=mysqli_query($con,"select DISTINCT subject from `addtable` where teacher='".$_SESSION['login']."' ");
                         while($da= mysqli_fetch_array($saa))
            {       
                          $class1=$da['subject'];
                          $cl= mysqli_query($con,"select * from subject where id = '$class1'");
                          $class= mysqli_fetch_array($cl);
   ?>
            <option  value="<?php echo $class[0];?>">
                <?php echo $class[1]; ?>
            </option>
            <?php   }?>
        </select>
        
        
        
		</div>
   
       

    
    
    
  <div  align="center">
 <button type="submit" name="upload" class="btn btn-default" style="background-color:#6F479F; color:#fff" >انشاء</button> </div>
    
     
   
    
</form>

 </div>
                    
 </div> </div>
 </div>


                 
                 
                         
                 
                 
                 
                 
                 
                 
                 
                 
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