
<?php 
include('includes/config.php');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
		
    <title>video</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>



<body>
<?php include('includes/header.php')?>
<?php include('includes/menubar.php');?>
<?php mysqli_set_charset($con, 'utf8');?>

     <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1  style="color:#6F479F; background-color:#fff; font-size:20px; font-weight: bold;">اضافه دورات تعزيزيه للمعلم  </h1>
                           <hr class="my-5">
                    </div>
                </div>
	  	  <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading" >
                           دورات تعزيزيه
                        </div>
                              <div class="row" >
	
	
	
		<h3  style="text-align:center" >
		<br> 
		<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> اضافة فيديو</button>
		
		<br /><br />
		<hr style="border-top:3px solid #ccc; width:553px;"/>
		<?php
			require 'connvi.php';
 
			$query = mysqli_query($con, "SELECT * FROM `videotea` ORDER BY `video_id` ASC") or die(mysqli_error());
			while($fetch = mysqli_fetch_array($query)){
		?>
		<div class="col-md-12">
			<div class="col-md-4" style="word-wrap:break-word;">
				<br />
				<h4>:اسم الفيديو</h4>
				<h5 class="text-primary"><?php echo $fetch['video_name']?></h5>
				<br > <br>
				<a href="savevi_teacher.php?delete=<?php echo $fetch ['video_id'] ?> &del=delete" onClick="return confirm('هل أنت متأكد أنك تريد الحذف؟')">
				<button class="btn btn-danger" style="background-color:#DC143C">حذف</button>
				    </a>
			</div>
			<div class="col-md-8">
				<video width="100%" height="240" controls>
					<source src="<?php echo $fetch['location']?>">
				</video>
			</div>
			<br style="clear:both;"/>
			<hr style="border-top:1px groovy #000;"/>
		</div>
		<?php
			}
		?>
	</div>
	<div class="modal fade" id="form_modal" aria-hidden="true">
		<div class="modal-dialog">
			<form action="savevi_teacher.php" method="POST" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-body">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label>اختر اسم الملف </label>
								<input type="file" name="video" class="form-control-file"/>
							</div>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger"style="background-color:#DC143C" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						<button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
   </div>
	</div>
                        </div>
            </div></div></div>
 <?php include('includes/footer.php');?>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>

</body>
</html>