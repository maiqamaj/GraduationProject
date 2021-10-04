<?php
error_reporting(0);
?>


        <div style=" background-color:#6F479F ; color:#fff; font-size:16px ;font-weight: bold;">
                            <img src="jel.png" alt="logo"style="max-height: 100px; padding:5px; padding-right:30px;"/>
            
        جيل الغد للتعليم الألكتروني
  
            
            <div  style="color:#fff; font-size:13px ; padding-right:75px;  background-color:#8967B0 " >
                  <?php  
              $sql=mysqli_query($con,"SELECT * FROM `teacher` where id='".$_SESSION['login']."' ");

          
          $row=mysqli_fetch_array($sql);

      echo "مرحباً بك ",$row['first_name'],' ',$row['second_name'],' ',$row['third_name'],' ',$row['last_name']; 
    
              echo "<br>","رقم المعلم : ",$row['id'];
                    
                    ?>
                
                </div>

      </div>
