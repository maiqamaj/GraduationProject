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

<?php
if(isset($_POST['edit']))
{ $class=$_POST['class'];
  $subject=$_POST['sub'];
  $student = $_POST['studentID'];

  $mark_1=$_POST['mark1'];
  $mark_2=$_POST['mark2'];
  $mark_3=$_POST['mark3'];
  $mark_4=$_POST['mark4'];
  $total=0;
  if  (is_numeric($mark_1) && is_numeric($mark_2) &&is_numeric($mark_3)&&is_numeric($mark_4)) {
	  $total = $mark_1+$mark_2+$mark_3+$mark_4;
  
} else if  (is_numeric($mark_1) && is_numeric($mark_2) &&is_numeric($mark_3)){
  $total = $mark_1+$mark_2+$mark_3;
}else if  (is_numeric($mark_1) && is_numeric($mark_2) ){
  $total = $mark_1+$mark_2;
}else if  (is_numeric($mark_1)) {
  $total = $mark_1;
}
  
  $check = true;
	$q1 =mysqli_query($con,"SELECT * FROM `mark` where id_student = '$student' AND id_section = '$class' AND id_subject = '$subject' ") or die(mysqli_error($con));
           
if (mysqli_num_rows($q1) > 0) {
    
$update = "UPDATE mark SET id_student='$student' , id_section= '$class', id_subject= '$subject', first_mark= '$mark_1', sec_mark= '$mark_2', third_mark= '$mark_3', final_mark= '$mark_4', total= '$total' where id_student = '$student' AND id_section = '$class' AND id_subject = '$subject'";
$results=mysqli_query($con,$update ) or die(mysqli_error($con));
$check  = false;
}

if($check ){
	$ret=mysqli_query($con,"insert into mark(id_student,id_section,id_subject,first_mark,sec_mark,third_mark,final_mark,total) values('$student','$class','$subject','$mark_1','$mark_2','$mark_3','$mark_4','$total')") or die(mysqli_error($con));
  if($ret)
{
  $_SESSION['msg']="تم الاضافة بنجاح";
}
else
{
    $_SESSION['msg']="لم تتم الاضافة بنجاح";
  } }}
if(isset($_POST['submit']))
{ 
 
    $class=$_POST['class'];
    $subject=$_POST['sub'];
    $student = $_POST['studentID'];

   
 

}
if(isset($_POST['upload']))
{   //$class=$_POST['class'];
    $class=$_POST['class'];
    $subject=$_POST['subject'];
	
	
}
if(isset($_POST['hid']))
{   
    $class=$_POST['class'];
    $subject=$_POST['sub'];
    $s = 0;
    $sql="update mark set status = '$s' where id_section='$class' AND id_subject='$subject'";

  
    $ret=mysqli_query($con,$sql);
	
}
if(isset($_POST['showT']))
{   
    $class=$_POST['class'];
    $subject=$_POST['sub'];
    $s = 1;
    $sql="update mark set statusTotal = '$s' where id_section='$class' AND id_subject='$subject'";

  
    $ret=mysqli_query($con,$sql);
	
}
if(isset($_POST['show']))
{   
    $class=$_POST['class'];
    $subject=$_POST['sub'];
    $s = 1;
    $sql="update mark set status = '$s' where id_section='$class' AND id_subject='$subject'";

  
    $ret=mysqli_query($con,$sql);
	
}
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
<a href="marks.php"> <b> <button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
      <!--------------------------------------------------------------------------------------->
    
    <!-- MENU SECTION END-->
             
   
 <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">

                  <?php 
                   $s=mysqli_query($con,"SELECT * FROM `course` where id = '$class' ");
                    $r1=mysqli_fetch_array($s);
                    $s1=mysqli_query($con,"SELECT * FROM `subject` where id = '$subject' ");
                    $r2=mysqli_fetch_array($s1);
                   ?>
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;"><?php echo "العلامات"," --> ",$r1[1]," ",$r1[2],"   -->  ",$r2[1]?></h1>
                           
                         <form method="post" action="markstd.php" > 
                                                   <table>
												   <body style="text-align:center">
												   <tr>
												   <td style="text-align:center">
                                                   <div  align="left">
                                                   <input name="class" type="hidden" id="class" value="<?php echo $class; ?>">
                                                   <input name="sub" type="hidden" id="sub" value="<?php echo $subject; ?>">
                                                
                                                   <button type="submit" name="show" class="btn btn-default" style="background-color:#6F479F; color:#fff; align:center" >اظهار العلامات الشهرية  </button> </div>
                                                 </td>
												 <td style="text-align:center">
                                                 </form>
                                                 <form method="post" action="markstd.php" > 
                                                   
                                                   <div  align="left">
                                                   <input name="class" type="hidden" id="class" value="<?php echo $class; ?>">
                                                   <input name="sub" type="hidden" id="sub" value="<?php echo $subject; ?>">
                                                
                                                   <button type="submit" name="hid" class="btn btn-default" style="background-color:#6F479F; color:#fff; align:center" >اخفاء العلامات الشهرية  </button> </div>
                                                 </td>
                                                 </form> 
												<td style="text-align:center">												 
                                                 <form method="post" action="markstd.php" > 
                                                   
                                                   <div  align="left">
                                                   <input name="class" type="hidden" id="class" value="<?php echo $class; ?>">
                                                   <input name="sub" type="hidden" id="sub" value="<?php echo $subject; ?>">
                                                
                                                   <button type="submit" name="showT" class="btn btn-default" style="background-color:#6F479F; color:#fff; align:center" >اظهار العلامة النهائية  </button> </div>
                                                 
                                                 </form> 
													</td>		</tr></body></table>										 
                         <hr class="my-5" >
                          <font color="green" align="center"><?php echo htmlentities($_SESSION['dm']);?><?php echo htmlentities($_SESSION['dm']="");?></font>

                    </div>
                    
                </div>
              

                <div class="panel panel-default">
                             

       
                                 <div class="table-responsive table-bordered">
                                     <table class="table">
                                       <thead>
                                         <tbody>
                                             <tr>
                                                  <th style="text-align:center">#</th>
                                               
                                                  <th style="text-align:center">الطالب</th>
                                                  <th style="text-align:center">التقويم الاول</th>
                                                  <th style="text-align:center">التقيم الثاني</th>
												  <th style="text-align:center">التقيم الثالث</th>
												  <th style="text-align:center">التقيم الرابع</th>
												  <th style="text-align:center">مجموع العلامات</th>
												  <th style="text-align:center">الاجراءات</th>
                                                 
                                                       
                                             
                                             
                                          <?php     $cnt=1; 
                                            
                                            
                                            
                                              $sql1=mysqli_query($con,"SELECT * FROM `student` where section_id = '$class' ");
                                            while(  $row1=mysqli_fetch_array($sql1))
                                            {
                                            
                                             ?>
                                             <tr>
                                                
                                                 
                                                 <td style="text-align:center"><?php echo $cnt;?></td>
                                              
                                               
                                           <td style="text-align:center"><?php 
                                             
                                                echo htmlentities($row1['first_name'])," ",$row1['second_name']," ",$row1['third_name']," ",$row1['last_name'];
                                                
   
                                           
                                           
                                           ?></td>
                                           <?php $s = $row1['id'];
                                            $sql2=mysqli_query($con,"SELECT * FROM `mark` where id_student = '$s' AND id_section = '$class' AND id_subject = '$subject' ") or die(mysqli_error($con));;
           
           $row2=mysqli_fetch_array($sql2);

         
          
                                        ?>   
                                       <td style="text-align:center"><?php if($row2['first_mark'] == 0)  echo " "; else echo htmlentities($row2['first_mark']);?></td>
												               <td style="text-align:center"><?php if($row2['sec_mark'] == 0)  echo " "; else echo htmlentities($row2['sec_mark']); ?></td>
												               <td style="text-align:center"><?php  if($row2['third_mark'] == 0)  echo " "; else echo htmlentities($row2['third_mark']); ?></td>
                                       <td style="text-align:center"><?php if($row2['final_mark'] == 0)  echo " "; else echo htmlentities($row2['final_mark']);  ?></td>

												  
                                                
												   <td style="text-align:center"><?php echo htmlentities($row2['total']); ?></td>
                                                   <td style="text-align:center">
                                                   
                                                   
                                                   <form method="post" action="markrsl.php" > 
                                                   
                                                    <div  align="center">
                                                    <input name="class" type="hidden" id="class" value="<?php echo $class; ?>">
                                                    <input name="sub" type="hidden" id="sub" value="<?php echo $subject; ?>">
                                                    <input name="studentID" type="hidden" id="studentID" value="<?php echo htmlentities($row1['id']); ?>">
                                                    <button type="submit" name="submit" class="btn btn-default" style="background-color:#6F479F; color:#fff" >اضافه </button> </div>
                                                  </form>
										



                                               
                                                 </td>
                                
                  
                                           
                                 </tbody>     <?php $cnt++;} ?>
         </table>
          </div>
           </div>    
                <hr>       
                     
     
            
          
       
      
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