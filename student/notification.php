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
         $details=$_POST['num'];
        $id=$_POST['idid'];
    $type=$_POST['type'];
$t=$_SESSION['login'];

 $insert = "insert into ajaxsave(id_student,type,id_hom,tr) values($t,$type,$id,$details)";
     $ret=mysqli_query($con,$insert);
    
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
    




?>

<!DOCTYPE html>
<html lang="en">
<?php $t;?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> الأشعارات</title>
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
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">اشعارات</h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>

     <div class="table-responsive table-bordered">
                                <table class="table">
                                  <thead>
                                    <tbody>
                                        <tr>
                                           
                                             <th style="text-align:center">اشعار</th>
                                        
                                        
                                        
                      <?php      
             $sql=mysqli_query($con,"SELECT * FROM `student` where id='".$_SESSION['login']."' ");
                                $classs= mysqli_fetch_array($sql); 
                        
                                  $s=mysqli_query($con,"SELECT * FROM `notification` where class='".$classs['section_id']."' ORDER BY currentdate DESC");
                   
                  while( $da= mysqli_fetch_array($s))                          
                                
{      
                                $teacher=$da['teacher'];    
      $sec=mysqli_query($con,"select first_name,second_name,third_name,last_name from teacher where id = '$teacher'");
  $teacher= mysqli_fetch_array($sec);
                                
                                $class1=$da['subject'];
                             $cl= mysqli_query($con,"select * from subject where id = '$class1'");
                        $id=$da['id_note'];
                   
                            $class= mysqli_fetch_array($cl);
                            
                                     if ($da['num_notification']=='1')
                                         { $t1=$teacher['first_name'];  
                                      $tt=$teacher['last_name'];
                                     
                                      $y=$class['subjectName'];  
                                                       $z=substr($da['currentdate'], 0, 11);
                                                       $z1=substr($da['currentdate'], 10,10);
                                          
                                          $ass='واجب';
                                        
                                           $link='showhomework.php?id=';
                                          $mai='1';
                                          $class1=$da['subject'];
                      $idid=  $da['id_note'];
                   $cl= mysqli_query($con,"select end_time from homework where id = '$idid' ");
                            $nnnn= mysqli_fetch_array($cl);
                            $vv=$nnnn[0];
                                     $color='red';
                                     }
                      
                      else if($da['num_notification']=='2'){
                          
                                   $t1=$teacher['first_name'];  
                                      $tt=$teacher['last_name'];
                                       $y=$class['subjectName'];  
                                          $z=substr($da['currentdate'], 0, 11);
                                           $z1=substr($da['currentdate'],10,10);
                                  $idid=  $da['id_note'];
                   $cl= mysqli_query($con,"select end_time from exam_tbl where exam_id = '$idid' ");
                            $nnnn= mysqli_fetch_array($cl);
                   $color='green';
                                        $vv=$nnnn[0];
                                          $ass='امتحان';
                                        $mai='2';
                                           $link='time-exam.php?id=';
                                     
                          
                      }


                       ?>  
            
            <?php  
      
                        $dd=$vv;
                       	date_default_timezone_set('Asia/Amman');
   
                      $current_datetime = date("Y-m-d H:i", strtotime('0 hours'));
        
                      $end_date = date("Y-m-d H:i", strtotime($dd));
                   
                  
                      if($current_datetime > $end_date){
                           $dedada="DELETE FROM notification where id_note = '".$da['id_note']."'";
                           $rfff=mysqli_query($con,$dedada);   
                             $de="DELETE FROM ajaxsave where id_hom = '".$da['id_note']."'";
                           $rnnn=mysqli_query($con,$de); 
                        } 
                       $t=$_SESSION['login'];
                            $cl= mysqli_query($con,"select * from ajaxsave where type = '".$da['num_notification']."'  and id_hom=$idid  and id_student=$t ");
                            if( mysqli_fetch_array($cl)>0)
                            {$cty='#F7F9F9';}  else {$cty='#D7DBDD';}
                   
    
                                            
                                            ?>
                                       
                                           <tr> <td style="text-align:center">
                                               <form method='post'>
                                                 <button name="butt" id='butt' type='submit' title="انقر هنا لعرض الاشعار" style='width:100%; height:100%; background-color:<?php echo $cty;?>; color:#000000; padding: 6px;'  >
                                                  <input value="<?php echo $link,$idid;?>" name ='link'
                                                         id='link' hidden>
                                                  <input value="<?php echo $mai;?>" name ='num'
                                                         id='num' hidden>
                                                      <input value="<?php echo $da['num_notification']?>" name ='type'
                                                         id='type' hidden>
                                                       <input value="<?php echo $idid;?>" name ='idid'
                                                         id='idid' hidden>
                                                     
                                                     
                                                   <div style="background-color:<?php echo $color;?>; color:#fafafa; border:none; padding: 6px; width:10%;" > <?php echo $ass;?> </div>   <?php echo '  التاريخ   ',$z,' الساعة ',$z1;?> 
                                                    <br><br>
                                                <div class="btn btn-primary"  style="background-color:#CACFD2; color:#000000;  width:70%;"> 
                                                        
                                                         
                                                        <?php echo 'يوجد لديك','&nbsp;',$ass,'&nbsp;','تمت اضافته من قبل المعلم'
														,'&nbsp;',$t1,'&nbsp;',$tt,' لمادة ', $y; ?>
                                                       
                                                        </div>  <br>  <br> </button>   <br></form>
                                                 
   

       </tr>     </tbody>  <?php } ?>
  
                                    </table></div>
                                    
 
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