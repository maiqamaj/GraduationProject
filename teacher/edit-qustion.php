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
$id=intval($_GET['id']);

if(isset($_POST['submit']))
{ 
 
    $question=$_POST['question'];
    $choice_A=$_POST['choice_A'];
    $choice_B=$_POST['choice_B'];
    $choice_C=$_POST['choice_C'];
    $choice_D=$_POST['choice_D'];
    $correctAnswer=$_POST['correctAnswer'];
    $mark=$_POST['mark'];
   
 
    if($question=='' or $choice_A=='' or $choice_B=='' or $choice_C=='' or $choice_D=='' or $mark==''){
      $_SESSION['msg']="لم يتم اضافة السؤال الرجاء كتابة جميع المعلومات بالشكل الصحيح";

    }else{
$t=$_SESSION['login'];
$exam_id=$_SESSION['exam_id'];
$sql="update exam_question_tbl set exam_question='$question',exam_ch1='$choice_A',exam_ch2='$choice_B',exam_ch3='$choice_C',exam_ch4='$choice_D',exam_answer='$correctAnswer',eq_mark='$mark' where eqt_id='$id'";

$ret=mysqli_query($con,$sql) or die(mysqli_error($con));
if($ret)
{
$_SESSION['msg']="تم تعديل السؤال بنجاح !!!";
}
else
{
    $_SESSION['msg']="لم يتم تعديل بنجاح";
  }}

$total_mark=0;
$numOfqustion=0;
$q1 =mysqli_query($con,"SELECT * FROM exam_question_tbl WHERE exam_id = '$exam_id'");
if (mysqli_num_rows($q1) > 0) {
    while ($row=mysqli_fetch_assoc($q1)) {
        $total_mark=$total_mark+$row['eq_mark'];
        $numOfqustion=$numOfqustion+1;
    }}
$update = "UPDATE exam_tbl SET ex_mark='$total_mark' , ex_questlimit_display= '$numOfqustion' WHERE exam_id = '$exam_id'";
$results=mysqli_query($con,$update ) or die(mysqli_error($con));
}
	

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>الاختبارات</title>
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
<a href="addqustion.php"> <b> <button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>
      <!--------------------------------------------------------------------------------------->
    
    <!-- MENU SECTION END-->
             
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">الاختبارات</h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
تعديل السؤال                       </div>
                             <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>

                        <div class="panel-body">
    <form  method="post" enctype="multipart/form-data">
    <div class="form-group">
    <?php   
    $id=intval($_GET['id']);  
    
$sql=mysqli_query($con,"select * from exam_question_tbl where eqt_id='$id'");
$cnt=1;     
while($row=mysqli_fetch_array($sql))
{ 
?>
                <label>علامة السؤال</label>
                <input type="number" name="mark" id="" class="form-control" placeholder="علامة السؤال" autocomplete="off" required=""  value="<?php echo htmlentities($row['eq_mark']);?>">
                            </div>
    <div  class="form-group" align="right" >
       <label>نص السؤال</label>
            <input type="hidden" name="examId" value="<?php echo $exId; ?>">
            <input type="" name="question" id="course_name" class="form-control" placeholder="ادخل السؤال" autocomplete="off" required="" value="<?php echo htmlentities($row['exam_question']);?>">
        
        
          </div>
         
          <fieldset>
            <legend>ادخل الخيارات</legend>
            <div class="form-group">
                <label> الخيار الاول</label>
                <input type="" name="choice_A" id="choice_A" class="form-control" placeholder="الخيار الاول" autocomplete="off" required="" required="" value="<?php echo htmlentities($row['exam_ch1']);?>">
        
        
            </div>

            <div class="form-group">
                <label> الخيار الثاني</label>
                <input type="" name="choice_B" id="choice_B" class="form-control" placeholder="الخيار الثاني" autocomplete="off" required="" required="" value="<?php echo htmlentities($row['exam_ch2']);?>">
        
        
            </div>

            <div class="form-group">
                <label>الخيار الثالث</label>
                <input type="" name="choice_C" id="choice_C" class="form-control" placeholder="الخيار الثالث" autocomplete="off" required="" required="" value="<?php echo htmlentities($row['exam_ch3']);?>">
        
        
            </div>

            <div class="form-group">
                <label>الخيار الرابع</label>
                <input type="" name="choice_D" id="choice_D" class="form-control" placeholder="الخيار الرابع" autocomplete="off" required="" required="" value="<?php echo htmlentities($row['exam_ch4']);?>">
        
        
            </div>

            <div class="form-group">
                <label>الاجابة الصحيحه</label>
                <input type="" name="correctAnswer" id="" class="form-control" placeholder="الاجابة الصحيحة" autocomplete="off" required="" required="" value="<?php echo htmlentities($row['exam_answer']);?>">
        
        
            </div>
          </fieldset>
     
      <div class="form-group">
        <button type="submit"  name="submit" class="btn btn-primary">تعديل</button>
      </div>
      <?php } ?> 
      </div>
      </div>
</form>

 </div>
                    
 </div> 
  
            
            
            
            
            
            
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