<?php
error_reporting(0);
?>


        <div style=" background-color:#6F479F ; color:#fff; font-size:14px ;font-weight: bold;">
                            <img src="jel.png" alt="logo"style="max-height: 100px; padding:5px; padding-right:30px;"/>
            
        جيل الغد للتعليم الألكتروني
      
           <div  style="color:#fff; font-size:13px ; padding-right:75px;  background-color:#8967B0 " >
                  <?php  
              $sql=mysqli_query($con,"SELECT * FROM `student` where id='".$_SESSION['login']."' ");

          
          $row=mysqli_fetch_array($sql);

      echo "مرحباً بك ",$row['first_name'],' ',$row['second_name'],' ',$row['third_name'],' ',$row['last_name']; 
    
              $s=mysqli_query($con,"SELECT * FROM `course` where id='".$row['section_id']."' ");
                                
                                         $c= mysqli_fetch_array($s); echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ",$c['className'],' ',$c['numOfSection'];
                 
                      echo "<br>","رقم الطالب : ",$row['id'];
                   ?>
                
                </div>

      </div>
