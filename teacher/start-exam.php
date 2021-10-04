<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
    
    
    
  
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>عرض الواجبات</title>
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
 <body style="font-family:Courier New; font-size:13px;">
<?php include('includes/header.php');?>
      <!--------------------------------------------------------------------------------------->
 <!-- MENU SECTION END-->
            
    <div class="content-wrapper">
        <div class="container">
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
بدء الاختبار                        </div>
        
                        <div class="panel-body">
    <form  method="post" action="resultExam.php" enctype="multipart/form-data">
    <div  class="form-group" align="right" >
      
<?php
$s=$_SESSION['login']; 
$id=$_POST['exam'];
$att=mysqli_query($con,"select * from exam_attempt where exmne_id='$s' AND exam_id='$id'");
$tacken=mysqli_num_rows($att);
if($tacken>0){
   $attData = mysqli_fetch_assoc($att);
   $mf = $attData['mark'];
   $mt = $attData['markExam'];
   echo("<h3><p style='text-align:center;'> لا يمكنك اعادة الاختبار و نتيجتك :</h3>");
   echo ("<h3><p style='text-align:center;'>$mf  من  $mt </h3>");

}else{
        $id=intval($_GET['id']);
        $sql=mysqli_query($con,"select * from exam_question_tbl where exam_id='$id'");
        $count=mysqli_num_rows($sql);
if($count>0){
    $i = 1;
                
while($row=mysqli_fetch_array($sql))
     
{           
   $questId = $row['eqt_id'];

  
?> <table> 
    <input name="examID" type="hidden" id="examID" value="<?php echo intval($_GET['id']); ?>"><br/>                     
    <tr>
                        <td>
   <p><b><?php echo $i++ ; ?>) <?php echo $row['exam_question']; ?></b></p>
   <div class="form-group" align="right">
                              <div class="form-group">
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $row['exam_ch1']; ?>" type="radio" value="" id="invalidCheck" required >
                               
                                
                                    <?php echo $row['exam_ch1']; ?>
                               
                              </div>  

 
                              <div class="form-group">
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $row['exam_ch2']; ?>"  type="radio" value="" id="invalidCheck" required >
                               
                                
                                    <?php echo $row['exam_ch2']; ?>
                              
                              </div>  

                              <div class="form-group">
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $row['exam_ch3']; ?>" type="radio" value="" id="invalidCheck" required >
                               
                                
                                    <?php echo $row['exam_ch3']; ?>
                               
                              </div>  

                              <div class="form-group">
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $row['exam_ch4']; ?>" type="radio" value="" id="invalidCheck" required >
                               
                              
                                    <?php echo $row['exam_ch4']; ?>
                            
                              </div>   
                              </div>
                            </div>
                            </td>
                    </tr>

                <?php }
                ?>

<tr>
                             <td style="padding: 20px;">
                                 
  <div  align="center">
 <button type="submit" name="submit" class="btn btn-default" style="background-color:#6F479F; color:#fff" >انهاء الاختبار</button> </div>
      </td>
                 </tr>

                 <?php
            }
            else
            { echo ("<h3><p style='text-align:center;'>لا يوجد اسئلة لهذه اللحظة </h3>");
              }
         ?>   
              
            <?php }
         ?>   
              </table>

        </form>
    </div>
</div>
 
                        
        
 
        
        
                      </div> 
                            
                            
</form>
                           
                            </div>
                    </div>
                  
                </div>
                
            </div>





        </div>
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