<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}




?>




<?php
if(isset($_POST['butt']))
{
      $extra=$_POST['link'];

$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
    

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> الواجبات</title>
  <!-- facebook/github Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
      <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />

</head>

<body  style="font-family:Courier New;  margin:0; ">
     <?php include('includes/header.php');?>    
	  <a href="home.php"> <b> <button  style="position: absolute; 
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
 <main>
      <!--///////////////؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟////////////////////-->  
                
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">الواجبات</h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>

   
                      <?php      
             $sql=mysqli_query($con,"SELECT * FROM `student` where id='".$_SESSION['login']."' ");
                                $class= mysqli_fetch_array($sql); 
                             
                                  $s=mysqli_query($con,"SELECT DISTINCT subject FROM `addtable` where class='".$class['section_id']."' ");
                 
           
       
                            while($da= mysqli_fetch_array($s))
    
{         
                       ?>   <div class="panel panel-default">
                                   
                        <div class="panel-heading">
                            <?php 
                             $class1=$da['subject'];
                           $cl= mysqli_query($con,"select * from subject where id = '$class1'");
                            $class= mysqli_fetch_array($cl);
                              
                                echo htmlentities($class['subjectName']);
                            
                            
                            ?>
                        </div>
  
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                  <thead>
                                    <tbody>
                                        <tr>
                                             <th style="text-align:center">#</th>
                                             <th style="text-align:center">المعلم</th>         
                                              <th style="text-align:center">بداية التسليم</th>
                                                 <th style="text-align:center">نهاية التسليم</th>
                                                <th style="text-align:center">تفاصيل/ملاحظات</th>
                                                  <th style="text-align:center">الإجراءات</th>
                                            
                                        
                                     <?php     $cnt=1;   
                                       $sql=mysqli_query($con,"SELECT * FROM `student` where id='".$_SESSION['login']."' ");
                                
                                         $c= mysqli_fetch_array($sql); 
                             
                                         $sql=mysqli_query($con,"SELECT * FROM `homework` where class='".$c['section_id']."' AND subject='".$class['id']."' ");
                                       while(  $row=mysqli_fetch_array($sql))
                                       {
                                               

 
    

      

     $teacher=$row['teacher'];    
      $sec=mysqli_query($con,"select first_name,second_name,third_name,last_name from teacher where id = '$teacher'");
  $teacher= mysqli_fetch_array($sec);

   $x=substr($row['start_time'], 0, 11);
   $x1=substr($row['start_time'], 10,10);
   $X=substr($row['end_time'], 0, 11);
   $X1=substr($row['end_time'], 10,10);
                         $start_date = date("Y-m-d H:i", strtotime($row['start_time']));
      $end_date = date("Y-m-d H:i", strtotime($row['end_time']));
  $start_day = date("Y-m-d H:i", strtotime($row['start_time']));
date_default_timezone_set('Asia/Amman');
    $current_datetime = date("Y-m-d H:i", strtotime('0 hours'));


  $link='submithomework.php?id=';
    if($current_datetime > $end_date or $current_datetime < $start_day){
   
          $c='disabled';
          
        
}   
else  { $c='';}
                                   ?>
                                        <tr>
                                           
                                            
                                            <td style="text-align:center"><?php echo $cnt;?></td>
                                
                                         <td style="text-align:center"><?php echo htmlentities($teacher['first_name'])," ",htmlentities($teacher['second_name'])," ",htmlentities($teacher['third_name'])," ",htmlentities($teacher['last_name']);?></td>
                                      
                                            <td style="text-align:center"><?php echo 'التاريخ : ',$x,'</br>','الساعة :',$x1; ?></td>
                     
                                         <td style="text-align:center"><?php echo 'التاريخ : ',$X,'</br>','الساعة :',$X1; ?></td>
                                         
                                                 <td style="text-align:center"><?php echo htmlentities($row['details']);?></td>
                                              <td style="text-align:center">
											   <a href="showhomework.php?id=<?php echo $row['id']?>">
                                                <button class="btn btn-primary" style="background-color:#008000;"> عرض الواجب</button> </a>  
                                                   <form method='post'>
                                                        <input value="<?php echo $link,$row['id'];?>" name ='link'
                                                         id='link' hidden>
                                                   
                                                
                                                  
                                                       
                                                <button  <?php echo $c?>    name="butt" id='butt' type='submit' title="انقر هنا لتسليم الواجب "  class="btn btn-primary" >تسليم الواجب </button>                       
                                                  </form>
							 					  
                            </tbody>     <?php $cnt++;} ?>
    </table>
     </div>
      </div>    
           <hr>       
                

  <?php } ?>
  
     
  
 
            <!--    Bordered Table  -->
            
            
                    
            
            
            
            
            
            
            
            
                                      </div></div>
   
    </main>
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