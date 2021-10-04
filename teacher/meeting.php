<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{

$class=$_POST['class'];
$link =$_POST['link'];
$subject=$_POST['subject'];
date_default_timezone_set('Asia/Amman');
$n = date("Y-m-d H:i:sA", strtotime('0 hours'));
 $start_time=date('Y-m-d  H:iA', strtotime($_POST['start_time']));
 $end_time=date('Y-m-d H:iA', strtotime($_POST['end_time']));

if($class=='' or  $class=='اختر الصف' or $link=='' or $subject=='اختر المادة' or $subject=='' or $start_time==''  or $end_time==''){
  $_SESSION['msg']="لم يتم انشاء الاجتماع الرجاء كتابة جميع المعلومات واختيارها بالشكل الصحيح";

}
else{
  
$t=$_SESSION['login'];
$vir = true; 
$q1 =mysqli_query($con,"SELECT id FROM meeting WHERE start_time = '$start_time'");
$count=mysqli_num_rows($q1);
if($count>0)
{   
$vir=false;
$_SESSION['msg']=" لم يتم انشاء الاجتماع وذلك لوجود اجتماع  بنفس الموعد";
}

if($vir){
  $q2 =mysqli_query($con,"SELECT id FROM meeting WHERE start_time BETWEEN '$start_time' AND '$end_time' ");
  $count=mysqli_num_rows($q2);
  if($count>0)
  {   
   $vir=false;
   $_SESSION['msg']=" لم يتم انشاء الاجتماع وذلك لوجود اجتماع  بنفس الفترة";}
  }

if($vir){
$result =mysqli_query($con,"SELECT id FROM meeting WHERE link='$link'");
$count=mysqli_num_rows($result);
if($count>0)
{   
 $vir=false;
 $_SESSION['msg']=" لم يتم أضافة الاجتماع الرجاء التأكد من الرابط لانه موجود مسبقا";
}

else{
    $reg3="/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
	if(!preg_match($reg3,$link)){
		$_SESSION['msg']=" لم يتم أضافة الاجتماع الرجاء التأكد من كتابة الرابط  بالشكل الصحيح  ";
		$vir=false;}
  }
}

if($vir){
$ret=mysqli_query($con,"insert into meeting(teacher,class , link , subject ,start_time,end_time) values('$t','$class' ,'$link' , '$subject','$start_time','$end_time' )");
if($ret)
{
$_SESSION['msg']="تم انشاء الاجتماع بنجاح !!!";
}
else
{
    $_SESSION['msg']="منشأ سابقا !!!!";
  }}
}
}
  if(isset($_GET['del']))
      {
              mysqli_query($con,"delete from meeting where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="تم حذف الاجتماع";
      }

    
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>الاجتماعات</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body  style="font-family:Courier New;  margin:0; ">

<?php include('includes/header.php');?>
<a href="home.php"> <b> <button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
<div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">اجتماعات  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            
                        <div  class="panel-heading" align="center">
                           اضافه اجتماع
                        </div>
                        
<font color="green" align="center">
<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>

    <div class="panel-body">

    <form  method="post" enctype="multipart/form-data">
    
    <div  class="form-group" align="right" >
			<label for="class">الصف</label> 
            <select  id="class" name="class"  class="form-control">    

<?php
           $saa=mysqli_query($con,"select DISTINCT class from `addtable` where teacher='".$_SESSION['login']."' ");
                         while($da= mysqli_fetch_array($saa))
            {       
                          $class1=$da['class'];
                          $cl= mysqli_query($con,"select * from course where id = '$class1'");
                          $class= mysqli_fetch_array($cl);
   ?>
   <option value="" disabled selected hidden>اختر الصف </option>
    <option  value="<?php echo $class[0];?>">
                <?php echo $class[1]," ",$class[2]; ?>
            </option>
            <?php   }?>
        </select> 
</div>




<div  class="form-group" align="right" >
			<label for="subject">الماده</label> 
            <select  id="subject" name="subject"  class="form-control">    

<?php
           $saa=mysqli_query($con,"select DISTINCT subject from `addtable` where teacher='".$_SESSION['login']."' ");
                         while($d= mysqli_fetch_array($saa))
            {       
                          $subject1=$d['subject'];
                          $sl= mysqli_query($con,"select * from subject where id = '$subject1'");
                          $subject= mysqli_fetch_array($sl);
   ?>
   <option value="" disabled selected hidden>اختر الماده </option>
    <option  value="<?php echo $subject[0];?>">
                <?php echo $subject[1]; ?>
            </option>
            <?php   }?>
        </select> 
</div>


  <div class="form-group" align="right">
    
    <label for="coursename" align="right">الرابط</label>
   <input type="text" class="form-control" id="link" name="link" placeholder="" required> 
  </div>

  <div  class="form-group" align="right" >
			<label for="class">بداية الاجتماع</label> 
         <input type="datetime-local" id="start_time" name="start_time" class="form-control" required=""></div>
    
     <div  class="form-group" align="right" >
			<label for="class">نهاية الاجتماع</label> 
         <input type="datetime-local" id="end_time" name="end_time" class="form-control" required=""></div>
  <br>
  <div  align="center">
 <button type="submit" name="submit" class="btn btn-default" style="background-color:#6F479F; color:#fff;" >اضافه</button> </div>
</form>
 </div>
                    
 </div> </div>
 </div>


 <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">الاجتماعات المضافة</h1>
                         <hr class="my-5" >
                          <font color="green" align="center"><?php echo htmlentities($_SESSION['dm']);?><?php echo htmlentities($_SESSION['dm']="");?></font>

                    </div>
                </div>

                <?php        
                 $saa=mysqli_query($con,"select DISTINCT class from `addtable` where teacher='".$_SESSION['login']."' ");
                            while($da= mysqli_fetch_array($saa))
    
{       
  
                       ?>  
					    <div class="panel panel-default">
                             

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

                                             <th style="text-align:center">الماده</th>
                                             <th style="text-align:center">الرابط</th>
											 <th style="text-align:center">  موعد بداية الاجتماع </th>
											 <th style="text-align:center">  موعد نهاية الاجتماع</th>
                                             <th style="text-align:center">الإجراءات</th>
                                             <?php  
									    $cnt=1; 
                                        
										$sql=mysqli_query($con,"SELECT DISTINCT * FROM `meeting` where class='".$da['class']."'AND teacher='".$_SESSION['login']."' ");
									  while(  $row=mysqli_fetch_array($sql))
									  {
											  
$class1=$row['class'];
$sec=mysqli_query($con,"select numOfSection from course where id = '$class1'");
$section= mysqli_fetch_array($sec);
$subject1=$row['subject'];
  $s1= mysqli_query($con,"select subjectName from subject where id = '$subject1'");
  $subject= mysqli_fetch_array($s1);
  $x=substr($row['start_time'], 0, 11);
  $x1=substr($row['start_time'],10,10);
  $X=substr($row['end_time'], 0, 10);
  $X1=substr($row['end_time'],10,10);
	 ?>
          <tr>
                                                                                      
         <td style="text-align:center"><?php echo $cnt;?></td>										 
         <td style="text-align:center"><?php echo htmlentities($subject['subjectName']);?></td>
         <td style="text-align:center"><?php echo htmlentities($row['link']);?></td>

         <td style="text-align:center"><?php echo 'التاريخ:' ,'</br>',$x,'</br>','الساعة:',$x1; ?></td>
                     
         <td style="text-align:center"><?php echo 'التاريخ:','</br>',$X,'</br>','الساعة:',$X1; ?></td>     
            
      
                                           
                                          
                                                      
           <td style="text-align:center">
           <a href="edit-meeting.php?id=<?php echo $row['id']?>">
             <button class="btn btn-primary" ><i class="fa fa-edit " ></i> تعديل</button> </a>                                    
              <a href="meeting.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('هل أنت متأكد من حذف الفيديو')">
                <button class="btn btn-danger" style="background-color:#DC143C">حذف</button>
                  </a>
      
                   </td>
                                


                   </tbody>     <?php $cnt++;} ?>
    </table>
     </div>
      </div>    
           <hr>       
                

        <?php    }   ?>
  

            
            
            
			</div></div>
            </div></div>
   

 
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

<?php 
}
 ?>
