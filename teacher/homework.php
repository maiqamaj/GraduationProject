<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}

?>

<?php
if(isset($_POST['upload']))
{ 
 $file = $_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
        $class=$_POST['class'];
        $subject=$_POST['subject'];
         $details=$_POST['details'];
    $start_time=date(' Y-m-d   H:iA ', strtotime($_POST['start_time']));
  $end_time=date(' Y-m-d   H:iA ', strtotime($_POST['end_time']));
 $nuum='1';
$t=$_SESSION['login'];
   
 /* new file size in KB */
 $new_size = $file_size/1024;  
 /* new file size in KB */
 
    
 /* make file name in lower case */
 $new_file_name = strtolower($file);
 /* make file name in lower case */
 date_default_timezone_set('Asia/Amman');
  $n = date("Y-m-d H:i:sA", strtotime('0 hours'));
 $final_file=str_replace(' ','-',$new_file_name);
    
  $final_file='../homework/'.$final_file;
    #$final_file='homework/'.$final_file;
 if(move_uploaded_file($file_loc,$final_file))
 {
  $sql="INSERT INTO homework(teacher,class,subject,start_time,end_time,file,type,size,details,sumbitbate) VALUES('$t','$class','$subject','$start_time','$end_time','$final_file','$file_type','$new_size','$details','$n')";
 $ret=mysqli_query($con,$sql);

   $cl= mysqli_query($con,"select id from homework where teacher = '$t' and class = '$class' and subject = '$subject' and  start_time = '$start_time'
   and end_time = '$end_time' and sumbitbate = '$n'
   ");
   $clasq= mysqli_fetch_array($cl);
   $ttt= $clasq['id'];

     
     $ss="INSERT INTO notification(teacher,num_notification,id_note,class,subject,currentdate) VALUES('$t',$nuum,'$ttt','$class','$subject','$n')";
      $rr=mysqli_query($con,$ss);
   

 
 
if($ret)
{
$_SESSION['msg']="تم انشاء الواجب بنجاح !!!";
        

}
else
{
    $_SESSION['msg']="منشأ سابقا !!!!";
  }
	}




}  
if(isset($_GET['del']))
      {     $de="DELETE FROM homework where id = '".$_GET['id']."'";
            $rt=mysqli_query($con,$de);
            $dedada="DELETE FROM notification where id_note = '".$_GET['id']."'";
            $rfff=mysqli_query($con,$dedada);
       $de="DELETE FROM ajaxsave where id_hom = '".$_GET['id']."'";
                           $rnnn=mysqli_query($con,$de); 
       if($rt)
       {  $_SESSION['dm']="تم حذف الجدول بنجاح";}
      }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>الواجبات</title>
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
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">الواجبات</h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
اضافه واجب                        </div>
                             <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>

                        <div class="panel-body">
    <form  method="post" enctype="multipart/form-data">
    <div  class="form-group" align="right" >
        
        
        
        
			<label for="class">الصف</label> <select  id="class" name="class"  class="form-control">   
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
        
        
           
			<label for="subject">المادة</label> <select  id="subject" name="subject"  class="form-control">   
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
     <div  class="form-group" align="right" >
			<label for="class">اختر الواجب</label> 
         <input type="file" name="file" class="form-control"/> </div>
     <div  class="form-group" align="right" >
			<label for="class">بداية التسليم</label> 
         <input type="datetime-local" id="start_time" name="start_time" class="form-control"></div>
    
     <div  class="form-group" align="right" >
			<label for="class">نهاية التسليم</label> 
         <input type="datetime-local" id="end_time" name="end_time" class="form-control"></div>
        
     <div  class="form-group" align="right" >
			<label for="details">تفاصيل/ملاحظات</label> <br/>
         <textarea  type="text" id="details" name="details"class="form" rows="5" cols="50"></textarea></div>
    
    
    
  <div  align="center">
 <button type="submit" name="upload" class="btn btn-default" style="background-color:#6F479F; color:#fff" >اضافه</button> </div>
    
     
   
    
</form>

 </div>
                    
 </div> </div>
 </div>

 <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">الواجبات المضافة</h1>
                         <hr class="my-5" >
                          <font color="green" align="center"><?php echo htmlentities($_SESSION['dm']);?><?php echo htmlentities($_SESSION['dm']="");?></font>

                    </div>
                </div>

   
                      <?php        
                 $saa=mysqli_query($con,"select DISTINCT class from `addtable` where teacher='".$_SESSION['login']."' ");
                            while($da= mysqli_fetch_array($saa))
    
{       
  
                       ?>   <div class="panel panel-default">
                             

                        <div class="panel-heading">
                            <?php
                                  $class1=$da['class'];
                           $cl= mysqli_query($con,"select * from course where id = '$class1'");
                            $class= mysqli_fetch_array($cl);
                                         
                                echo htmlentities($class['className'])," ",$class['numOfSection'];?>
                        </div>
  
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                  <thead>
                                    <tbody>
                                        <tr>
                                             <th style="text-align:center">#</th>
                                          
                                             <th style="text-align:center">المادة</th>
                                             <th style="text-align:center">الملف</th>
                                             <th style="text-align:center">بداية التسليم</th>
                                                 <th style="text-align:center">نهاية التسليم</th>
                                                <th style="text-align:center">تفاصيل/ملاحظات</th>
                                                  <th style="text-align:center">الإجراءات</th>
                                        
                                        
                                     <?php     $cnt=1; 
									 
                                        
                                         $sql=mysqli_query($con,"SELECT DISTINCT * FROM `homework` where class='".$da['class']."'
										 AND teacher='".$_SESSION['login']."' ");
                                       while(  $row=mysqli_fetch_array($sql))
                                       {
                                               
    $class1=$row['subject'];
  $cl= mysqli_query($con,"select * from subject where id = '$class1'");
  $class= mysqli_fetch_array($cl);
 

$x=substr($row['start_time'], 0, 11);
   $x1=substr($row['start_time'],  10,10);
   $X=substr($row['end_time'], 0, 11);
   $X1=substr($row['end_time'],  10,10);
                                           
                                        ?>
                                        <tr>
                                           
                                            
                                            <td style="text-align:center"><?php echo $cnt;?></td>
                                         
                                          
                                      <td style="text-align:center"><?php echo htmlentities($class['subjectName']);?></td>
                                      <td style="text-align:center"><?php echo htmlentities($row['file']);?></td>
                                        <td style="text-align:center"><?php echo 'التاريخ : ',$x,'</br>','الساعة :',$x1; ?></td>
                     
                                         <td style="text-align:center"><?php echo 'التاريخ : ',$X,'</br>','الساعة :',$X1; ?></td>     
                                                 <td style="text-align:center"><?php echo htmlentities($row['details']);?></td>
                                              <td style="text-align:center">
                                                  
                                                    <a href="showhomework.php?id=<?php echo $row['id']?>">
                                                <button class="btn btn-primary" style="background-color:#008000;"> عرض</button> </a>  
                                                  
                                            <a href="edit-homework.php?id=<?php echo $row['id']?>">
                                                <button class="btn btn-primary" ><i class="fa fa-edit " ></i> تعديل</button> </a>                                         
  <a href="homework.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('هل أنت متأكد من حذف الواجب')">
                                            <button class="btn btn-danger" style="background-color:#DC143C">حذف</button>
</a>

                                            </td>
                           
             
                                      
                            </tbody>     <?php $cnt++;} ?>
    </table>
     </div>
      </div>    
           <hr>       
                

        <?php        }              ?>
  
     
  
 
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