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

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>المعدل</title>
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
                  <?php 
                   ?>
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">المعدل</h1>
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
                                               
                                                  <th style="text-align:center">المادة</th>
												  <th style="text-align:center">المعدل</th>
											</tr>
                                                 
                                                       
                                             
                                             
                                          <?php     $cnt=1; 
                                            
                                            $id=$_SESSION['login'];
                    $s=mysqli_query($con,"SELECT * FROM `student` where id = '$id' ");
                    $r1=mysqli_fetch_array($s);
                    $idClass = $r1['section_id'];
                
                                            
                                              $sql1=mysqli_query($con,"SELECT DISTINCT subject FROM `addtable` where class = '$idClass' ");
                                            while(  $row=mysqli_fetch_array($sql1))
                                            {
                                                $idSub = $row['subject'];
                                                $s2=mysqli_query($con,"SELECT * FROM `subject` where id = '$idSub' ");
                                               
                                                 
                                            while($row1=mysqli_fetch_array($s2))
                                            {
                                                $subject = $row1['id'];
                                                $sql2=mysqli_query($con,"SELECT * FROM `mark` where id_student = '$id' AND id_section = '$idClass' AND id_subject = '$subject' ") or die(mysqli_error($con));;
                                                $row2=mysqli_fetch_array($sql2);
                                                if($row2['statusTotal']){



                                                  ?>
                                                  <tr>
                                                     
                                                      
                                                      <td style="text-align:center"><?php echo $cnt;?></td>
                                                   
                                                    
                                                
                                                       <td style="text-align:center"><?php  echo htmlentities($row1['subjectName']);?></td>
                                                        <td style="text-align:center"><?php if($row2['total'] == 0)  echo " "; else echo htmlentities($row2['final_mark']);  ?></td>
                               
                                                     
                                     
                       
                                                
                                      </tbody>     <?php $cnt++;}
                                      else{   ?>
                                       <tr>
                                                     
                                                      
                                       <td style="text-align:center"><?php echo $cnt;?></td>
                                    
                                     
                                 
                                       <td style="text-align:center"><?php  echo htmlentities($row1['subjectName']);?></td>
                                        
                                         <td style="text-align:center"></td>
                
                                      
                      
        
                                 
                       </tbody>     <?php $cnt++;}
                                      }}?>
     
     
								
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