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
  <title> صفحه الطالب </title>
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
                         <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold"> كورسات تقويه ل تحسين مهارات الطالب</h1>
                         <hr class="my-5" >
                         
                    </div>
                </div>

    <br>
  
<?php

$sql=mysqli_query($con,"SELECT * FROM `student` where id='".$_SESSION['login']."' ");
$class= mysqli_fetch_array($sql); 
$sql=mysqli_query($con,"SELECT * FROM `video_lesson` where class='".$class['section_id']."' ");

while($fetch = mysqli_fetch_array($sql)){
?>
<div class="col-md-4">

    <br />
    <h3  class="text-primary"><?php echo $fetch['video_name'] ?>  </h3>
   
    </div>
			<div class="col-md-8">
				<video width="60%" height="150" controls>
					<source src="<?php echo $fetch['location']?>">

				</video>
			</div>
			<br style="clear:both;"/>
			<hr style="border-top:1px groovy #000;"/>




		<?php
			}
		?>    

     
      </div>
                     
     </div>
             

</main>
<footer>
    <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>    
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script> </footer>
</body>
</html>