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
  <title> الجدول الدراسي </title>
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
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">الجدول الدراسي</h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>

   
                      <?php      
            
             $saa=mysqli_query($con,"select DISTINCT class from `addtable` where teacher='".$_SESSION['login']."' ");
                            while($da= mysqli_fetch_array($saa))
    
{       
         
  
                       ?>   <div class="panel panel-default">
                                   
                        <div class="panel-heading">
                            <?php   $class1=$da['class'];
                           $cl= mysqli_query($con,"select * from course where id = '$class1'");
                            $clas= mysqli_fetch_array($cl);
                                echo ($clas[1]." ".$clas[2]);?>
                        </div>
  
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                  <thead>
                                    <tbody>
                                        <tr>
                                             <th style="text-align:center">#</th>
                                            <th style="text-align:center">المادة</th>
                                             
                                        
                                     <?php     $cnt=1; 
                                        
                                         $sql=mysqli_query($con,"SELECT * FROM `addtable` where teacher='".$_SESSION['login']."'AND class='$class1'");
                                       while(  $row=mysqli_fetch_array($sql))
                                       {
                                  
    
      $subject=$row['subject'];    
      $sec=mysqli_query($con,"select subjectName from subject where id = '$subject'");
  $subject= mysqli_fetch_array($sec);
     
 
                                        ?>
                                        <tr>
                                           
                                            
                                            <td style="text-align:center"><?php echo $cnt;?></td>
                                         
                                            <td style="text-align:center"><?php echo htmlentities($subject['subjectName']);?></td>
                                       
                                           
                                           
                                      
                            </tbody>     <?php $cnt++;} ?>
    </table>
     </div>
      </div>    
           <hr>       
                

        <?php        }              ?>
  
     
  
 
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