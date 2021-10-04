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
    <title>عرض نتائج الاختبار</title>
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
اجابات الطالب                         </div>
        
                        <div class="panel-body">
    <form  method="post"  enctype="multipart/form-data">
    <div  class="form-group" align="right" >
      
<?php
$id =$_POST['examID']; 
$s = $_POST['studentID']; 
$markful = 0;
$marks= 0;

$sql1=mysqli_query($con,"select * from exam_attempt where exmne_id='$s' AND exam_id='$id' ");
$count1=mysqli_num_rows($sql1);

if($count1>0){

        $sql=mysqli_query($con,"select * from exam_question_tbl where exam_id='$id'");
        $count=mysqli_num_rows($sql);
if($count>0){
    $i = 1;
                
while($row=mysqli_fetch_array($sql))
     
{           
   $questId = $row['eqt_id'];
   $sql2=mysqli_query($con,"select exans_answer from exam_answers where exam_id='$id' AND student_id=$s AND quest_id=$questId");
   $markcurrect = 0;
   $qm =0;

   $row2 = mysqli_fetch_assoc($sql2);
   $value = $row2['exans_answer'];
?> 

<table> 
                      
<tr>
                    <td>
<p><b>  <?php echo $i++ ; ?>) <?php echo $row['exam_question']; 
?></b></p>
<div class="form-group" align="right">
                          <div class="form-group">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input value="<?php echo $row['exam_ch1']; ?>"  <?php  if($row['exam_ch1'] == $value) echo "checked"; else echo "disabled" ;?> type="radio"   required >
                           
                            
                                <?php echo $row['exam_ch1']; ?>
                           
                          </div>  


                          <div class="form-group">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <input value="<?php echo $row['exam_ch2']; ?>"  type="radio" value="" id="invalidCheck"  <?php  if($row['exam_ch2'] == $value) echo "checked"; else echo "disabled" ; ?>  required >
                           
                            
                                <?php echo $row['exam_ch2']; ?>
                          
                          </div>  

                          <div class="form-group">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <input  value="<?php echo $row['exam_ch3']; ?>" type="radio" value="" id="invalidCheck"  <?php  if($row['exam_ch3'] == $value) echo "checked" ; else echo "disabled" ;?>  required >
                           
                            
                                <?php echo $row['exam_ch3']; ?>
                           
                          </div>  

                          <div class="form-group">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <input  value="<?php echo $row['exam_ch4']; ?>" type="radio" value="" id="invalidCheck"  <?php  if($row['exam_ch4'] == $value) echo "checked"; else echo "disabled" ;?> required >
                           
                          
                                <?php echo $row['exam_ch4']; ?>
                        
                          </div> 
                          <div>
                          <?php
                          
if($row['exam_answer'] == $value){
$markcurrect = $row['eq_mark'];
$qm = $row['eq_mark'];
echo "<p style='text-align:center; color:green; background:#dbdde6;'> الاجابة صحيحة والعلامة لهذا السؤال هي $markcurrect  من  $qm </p>"; 
$marks= $marks + $markcurrect;
$markful = $markful + $qm ;
} else{
$qm = $row['eq_mark'];
$c = $row['exam_answer'];
$markful = $markful + $qm;
echo "<p style='color:red; background:#dbdde6; text-align:center;'> الاجابة خاطئة والعلامة لهذا السؤال هي 0  من  $qm  "; 
echo "<p style='color:green; text-align:center;'> الاجابة الصحيحة هي $c ";

}
?>
                          </div>  
                          </div>
                        </div>
                        </td>
                    
                </tr>
              
 
      
        
 </table>
 <div> 
         <?php } echo "<p style='background:#6F479F; color:#fff;  text-align:center;'> علامتك الكلية هي  $marks من $markful"; } }
            
            else{
              echo "<p style='color:red; text-align:center;'> لم تتقدم للاختبار ";

            }  
            ?>
            </div> 
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