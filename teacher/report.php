<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}

else {

?>
<?php



$class11=intval($_GET['class']);
$subject11=intval($_GET['subject']);


?>


<!DOCTYPE html>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>معلومات الطالب</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<style>

.style1 {
	font-family: "Courier New";
	font-size: 60px;
	color: #FFFFFF;
}
.style2 {
	font-size: 20px;
	color: white;
}
.style6 {font-size: 16px}

</style>
<body >
<?php include('includes/header.php');?>
<a href="attend-absence.php"> <b> <button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>

<br>

<table width="800" border="1" align="center">
<table width="800" border="1" align="center">


      <br>     
		<?php
		if(isset($_POST["btnsubmit"]))
		{
			extract($_POST);
			$query = "select * from `student` where id = ".$eno." limit 1";

			$result = mysqli_query($con,$query)or die("select error error");
			while($rec = mysqli_fetch_array($result))
			{
				echo '<tr><td colspan="2"><table width="400" border="2" align="center" bordercolor="#9966FF" bgcolor="#C7B6B1">
				<tr>
				  <td width="160" bgcolor="#9999CC"><span class="style2">رقم الطالب</span></td>
				  <td width="160" bgcolor="#9999CC"><span class="style2">الاسم</span></td>';

				    $query1 = "select * from `attendance` where student_id = ".$rec['id']." order by date";
					$result1 = mysqli_query($con,$query1)or die("select error error");
					while($rec1 = mysqli_fetch_array($result1))
					{
				  		echo '<td bgcolor="#9999CC" class=style2>'.$rec1["date"].'</td>';
					}
				echo '</tr>
				<tr>
				  <td width="222"><span class="style6">'.$rec["id"].'</span></td>
				  <td width="222"><span class="style6">'.$rec["first_name"].'  '.$rec["second_name"].'  '.$rec["third_name"].'  '.$rec["last_name"].'</span></td>';

				  $query1 = "select *from `attendance` where `student_id` = ".$rec["id"]." order by date";
					$result1 = mysqli_query($con,$query1)or die("select error error");
					while($rec1 = mysqli_fetch_array($result1))
					{
				  		echo '<td>';
						if($rec1["attendance"]==0)
							echo "غائب";
						else
							echo "حاضر";
						echo '</td>';
					}
				
				echo '
				</tr>
								
			 </td></tr> </table>;';
			}
		}
	
		else
		{
			extract($_POST);
            
            
          
                      $cl= mysqli_query($con,"select className,numOfSection from course where id = '$class11'");
                      $class= mysqli_fetch_array($cl);   

                        $subj= mysqli_query($con,"select subjectName from subject where id = '$subject11'");
                      $subj= mysqli_fetch_array($subj);
            echo "<center style='font-size:17px'>".$class[0]," ",$class[1];
            echo "/".$subj[0]."</center>";
			
			$query = "select * from `student` where section_id=$class11 ";
            
			$result = mysqli_query($con,$query)or die("select error error");
			while($rec = mysqli_fetch_array($result))
			{
				echo '<tr><td colspan="3"><table width="100%" border="2" align="center" bordercolor="#9966FF" bgcolor="#C7B6B1">
				<tr>
				  <td width="160" bgcolor="#9999CC"><span class="style2"> رقم الطالب</span></td>
				  <td width="160" bgcolor="#9999CC"><span class="style2">الاسم</span></td>';


				  $query1 = "select * from `attendance` where `student_id` = ".$rec["id"]." and subject=$subject11 order by date";
					$result1 = mysqli_query($con,$query1)or die("select error error");
					while($rec1 = mysqli_fetch_array($result1))
					{
						$class1=$rec1['class'];
                      $cl= mysqli_query($con,"select className from course where id = '$class1'");
                      $class= mysqli_fetch_array($cl);   

                        $subj= mysqli_query($con,"select subjectName from subject where id = '$subject11'");
                      $subj= mysqli_fetch_array($subj);
                      $sec=mysqli_query($con,"select numOfSection from course where id = '$class1'");
                      $section= mysqli_fetch_array($sec);
				  		echo '<td bgcolor="#9999CC" class=style2>'.$rec1["date"].'</td>';
					}
				echo '</tr>
				<tr>
				  <td width="222"><span class="style6">'.$rec["id"].'</span></td>
				  <td width="222"><span class="style6">'.$rec["first_name"].'  '.$rec["second_name"].'  '.$rec["third_name"].'  '.$rec["last_name"].'</span></td> ';

				  $query1 = "select *from `attendance` where `student_id` = ".$rec["id"]." order by date";
					$result1 = mysqli_query($con,$query1)or die("select error error");
					while($rec1 = mysqli_fetch_array($result1))
					{
				  		echo '<td>';
						if($rec1["attendance"]==0)
							echo "غائب";
						else
							echo "حاضر";
						echo '</td>';
					}
				
				echo '
				</tr>
								
			 </td></tr> </table>';
			}
		}
		?>    
    </table>
    <br> <br> <br> <br><br> <br></table>
    <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>

    <?php 
}
 ?>
