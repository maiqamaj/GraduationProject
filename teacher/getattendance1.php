<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'onlinecourse');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
?>

<?php
	if(isset($_POST["btnsubmit"]))
	{
	
		
		$CLASS=$_POST['class_id'];  
	 
		$SUBJECT=$_POST['subject_id']; 
		
		$date = $_POST["cyear"]."-".$_POST["cmonth"]."-".$_POST["cdate"];
		
		$query = "select * from `student` where section_id='".$CLASS."' ";
		$result = mysqli_query($con,$query)or die("select error");
		while($rec = mysqli_fetch_array($result))
		{
			$mno = $rec["id"];
			

			if(isset($_POST[$mno]))
			{
				
				$query1=mysqli_query($con,"insert into attendance(student_id,class , subject ,date,attendance) values('$mno','$CLASS','$SUBJECT','$date','1')");
				
			}
			else
			{
				
				$query1=mysqli_query($con,"insert into attendance(student_id,class , subject ,date,attendance) values('$mno','$CLASS','$SUBJECT','$date','0')");
				}
				
			print "<script>";
			print "alert('تمت اضافه الحضور والغياب بنجاح');";
			print "self.location='attend-absence.php';";
			print "</script>";
		}
		
		
			
		
	}
	else
	{
		header("Location:attend-absence.php");
	}
	
?>


