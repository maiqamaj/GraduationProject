<?php
	date_default_timezone_set('Asia/Amman');
	require_once 'connvi.php';
	
	if(ISSET($_POST['save'])){
		$file_name = $_FILES['video']['name'];
		$file_temp = $_FILES['video']['tmp_name'];
		$file_size = $_FILES['video']['size'];
		
		if($file_size < 100000000000000000){
			$file = explode('.', $file_name);
			$end = end($file);
			$allowed_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4');
			if(in_array($end, $allowed_ext)){
				$name = $file_name;
				$location = '../video/'.$name.".".$end;
				$id = 0;
				if(move_uploaded_file($file_temp, $location)){
					mysqli_query($con, "INSERT INTO `video` VALUES('$id' , '$name', '$location')") or die(mysqli_error());
					echo "<script>alert(' تم اضافة الفيديو')</script>";
					echo "<script>window.location = 'indexvi.php'</script>";
				}
			}else{
				echo "<script>alert('  صيغة الفيديو خاطئ')</script>";
				echo "<script>window.location = 'indexvi.php'</script>";
			}
		}else{
			echo "<script>alert(' حجم الفيديو كبير للغاية')</script>";
			echo "<script>window.location = 'indexvi.php'</script>";
		}
	}
	if(ISSET($_GET['delete'])){
		$id = $_GET['delete'];
		mysqli_query($con, "DELETE FROM video WHERE video_id = $id ") or die(mysqli_error());
		echo "<script>window.location = 'indexvi.php'</script>";

	}
  

?>