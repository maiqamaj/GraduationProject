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
$compName=$_POST['compName'];
$link =$_POST['link'];
$details=$_POST['details'];

$vir=true;
$result =mysqli_query($con,"SELECT link FROM competition WHERE link='$link'");
$count=mysqli_num_rows($result);
if($count>0)
{   
 $vir=true;
 $_SESSION['msg']=" تم اضافة المسابقه";
}
else{
    $reg3="/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
	if(!preg_match($reg3,$link)){
		$_SESSION['msg']=" لم يتم أضافة المسابقه الرجاء التأكد من كتابة الرابط  بالشكل الصحيح  ";
		$vir=false;}}


if($vir){
$ret=mysqli_query($con,"insert into competition(class,compName , link ,details) values('$class','$compName' ,'$link' ,'$details' )");
if($ret)
{
$_SESSION['msg']="تم انشاء المسابقه بنجاح !!!";
}
else
{
    $_SESSION['msg']="منشأ سابقا !!!!";
  }
}
}
  if(isset($_GET['del']))
      {
              mysqli_query($con,"delete from competition where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="تم حذف المسابقه";
      }
  
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>المسابقه</title>
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
<a href="home.php"><b><button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
<div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">مسابقات  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            
                        <div  class="panel-heading" align="center">
                           اضافه مسابقه
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


  
  <div class="form-group" align="right">
    <label for="coursecode" align="right">نوع المسابقه</label>
	<select class="form-control" id="compName" name="compName" required> 
    
     <option value="" disabled selected hidden>اختر المسابقه </option>	
    
	<option  value="مسابقة دينيه" name="compName" >مسابقة دينيه</option> 
    <option  value="مسابقة دينيه" name="compName" >مسابقة وطنيه</option>   
    <option value="مسابقة تعليميه" name="compName">مسابقة تعليميه</option>  
	<option value="مسابقة ترفيهيه" name="compName" >مسابقة ترفيهيه</option>  
	<option value="سؤال وجواب" name="compName" >سؤال وجواب </option>  
	<option value=" العاب" name="compName" >العاب </option>  
	
	</select>  
    </div>

    <div class="form-group" align="right">
    <label for="coursename" align="right">الرابط</label>
   <input type="text" class="form-control" id="link" name="link" placeholder="" required> 

  </div>
   
  <div  class="form-group" align="right" >
			<label for="details">ملاحظات</label> <br/>
         <textarea  type="text" id="details" name="details"class="form" rows="5" cols="50"></textarea></div>

  <div  align="center">
 <button type="submit" name="submit" class="btn btn-default" style="background-color:#6F479F; color:#fff;" >اضافه</button> </div>
</form>

 </div>
                    
 </div> </div>
 </div>



 <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ادارة المسابقات
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead >
                                        <tr style="text_align:right">
                                            <th style="text-align:center">#</th>
                                            <th style="text-align:center"> الصف</th>
                                            <th style="text-align:center"> الشعبه</th>
                                            <th style="text-align:center">نوغ المسابقه</th>				
                                            <th style="text-align:center">الرابط</th>	
                                            <th style="text-align:center">ملاحظات</th>			
											<th style="text-align:center">الاجراء</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select * from competition");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{ $class1=$row['class'];
  $cl= mysqli_query($con,"select className from course where id = '$class1'");
  $class= mysqli_fetch_array($cl);
  $sec=mysqli_query($con,"select numOfSection from course where id = '$class1'");
  $section= mysqli_fetch_array($sec);
?>

                                          <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($class['className']);?></td>
                                            <td><?php echo htmlentities($section['numOfSection']);?></td>
                                            <td><?php echo htmlentities($row['compName']);?></td>
                                            <td><?php echo htmlentities($row['link']);?></td>
                                            <td style="text-align:center"><?php echo htmlentities($row['details']);?></td>

                                            <td>
<a href="competition.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('هل أنت متأكد أنك تريد حذف؟')">
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
</div>





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


 <!---<form name="dept" method="post">

   <div class="form-group" align="right">
    <label for="coursecode" align="right">اسم المسابقه</label>
	<select class="form-control" id="compName" name="compName" required> 
    
     <option value="" disabled selected hidden>اختر المسابقه </option>	
    
	<option  value="مسابقة دينيه" name="compName" >مسابقة دينيه</option> 
    <option  value="مسابقة دينيه" name="compName" >مسابقة وطنيه</option>   
    <option value="مسابقةالفواكه" name="compName">مسابقة تعليميه</option>  
	<option value="مسابقة ترفيهيه" name="compName" >مسابقة ترفيهيه</option>  
	<option value="سؤال وجواب" name="compName" >سؤال وجواب </option>  
	<option value=" العاب" name="compName" >العاب </option>  
	
	</select>  
    -->