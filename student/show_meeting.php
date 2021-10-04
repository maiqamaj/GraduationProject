<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> الاجتماعات  </title>
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
                
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold"> الاجتماعات </h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>

             
     <center><div style=" background-color: #fafafa;  max-width:1000px;  " >  
           <div style=" width:100%; text-align: center;">
 
<?php
require 'connvi.php';
$cnt=1;   
$sql=mysqli_query($con,"SELECT * FROM `student` where id='".$_SESSION['login']."' ");
$class= mysqli_fetch_array($sql); 

$sql=mysqli_query($con,"SELECT * FROM `meeting` where class='".$class['section_id']."' ");
while(  $row=mysqli_fetch_array($sql))
{  
        

  $subject1=$row['subject'];
  $s1= mysqli_query($con,"select subjectName from subject where id = '$subject1'");
  $subject= mysqli_fetch_array($s1);
  ?>
   
   <div  style="display: inline-block;
    align-content: space-between;  max-width:210px; ">
   <a href= "<?php echo $row['link'] ?>" style="text-decoration:none;">
         <?php  
                    if($subject['subjectName']=='الرياضيات' or $subject['subjectName']=='الماليه')
                                 $xx= 'img/m1.png';
                    else  if($subject['subjectName']=='اللغه الانجليزيه' or $subject['subjectName']=='اللغه الفرنسيه')
                                $xx='img/eng.png'; 
                    else  if($subject['subjectName']=='العلوم'  or $subject['subjectName']=='الفيزياء'  or $subject['subjectName']=='الاحياء'  or $subject['subjectName']=='الكيمياء'  or $subject['subjectName']=='علوم ارض')
                                $xx='img/se.png'; 
                     else  if($subject['subjectName']=='اللغه العربيه' or $subject['subjectName']=='التربيه الاسلاميه')
                                $xx='img/ar.png'; 
                     else  if($subject['subjectName']=='الحاسوب')
                                $xx='img/has.png'; 
               
                    else  if($subject['subjectName']=='الفن')
                                $xx='img/ff.png'; 
                     else  if($subject['subjectName']=='الاجتماعيات' or $subject['subjectName']=='تاريخ'  or $subject['subjectName']=='وطنيه' or $subject['subjectName']=='الجغرافيا')
                                $xx='img/aj.png'; 
                    else  if($subject['subjectName']=='الرياضه')
                                $xx='img/ff.png'; 


      
      
                       ?>
    <button class="button" title="للدخول الى الاجتماع انقر هنا" style="  width:170px; height: 150px; background-image: url(<?php  echo $xx; ?>); background-repeat: no-repeat;
  background-size: 100% 100%; ">  
     
      
        

     </button> 
         <?php  echo "<h5 style='color:#6F479F'><b>",$subject['subjectName'],'</b></h5></a>';
    $x=substr($row['start_time'], 0, 11);
                    echo '<h6 style="color:#6F479F"><b>',' 
                    التاريخ : ',$x,'</b></h6>';
        
        $x1=substr($row['start_time'], 10,10);
        $x2=substr($row['end_time'],10,10);
        ?> 
        
       <h6>  <div style="color:#000 ; margin: 5px;"><?php echo  "  من الساعة  :  ",   $x1 ;?></div>
         <div style="color:#000 ;  margin: 5px;">  <?php   echo  "الى الساعة :" ,$x2?></div></h6>
                  
       
    </div>
               
               <div style='display: inline-block;
    align-content: space-between; '> &nbsp;&nbsp;  </div>

    
		<?php
			}
		?>    
        </div>
 </div>
         </div></div></center>
</main>
    <!-- CONTENT-WRAPPER SECTION
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
 <!----
             