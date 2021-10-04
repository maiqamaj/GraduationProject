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
  <title> صفحه المعلم </title>
  <!-- facebook/github Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">

</head>
<div class="container-fluid">
<?php

$sql =mysqli_query($con,"SELECT id,username as full_name FROM admin");
$admins = mysqli_fetch_all($sql,MYSQLI_ASSOC);
$sql =mysqli_query($con,"SELECT s.section_id,s.id,CONCAT(first_name,' ',second_name,' ',last_name) as full_name,c.className FROM student as s
inner join course as c on c.id  = s.section_id");
$students = mysqli_fetch_all($sql,MYSQLI_ASSOC);


$sql =mysqli_query($con,"SELECT * from course ");
$classes = mysqli_fetch_all($sql,MYSQLI_ASSOC);




//var_dump($classes);die;


?>    
    <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>المعلم | التواصل</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
</div>
<body>
<?php include('includes/header.php');?>
<a href="home.php"> <b> <button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>

    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">التواصل مع اﻷدمن  </h1>
                    </div>
                </div>
                <div class="row" >
            
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        اسم الادمن  
                        </div>   
                            <table class="table">
                                
                                <?php foreach($admins as $admin){ ?>
                                <tr>
                                    <td>
                                        <a href="StartChat.php?type=a&id=<?php echo $admin['id'] ?>"> <?php echo $admin['full_name'] ?></a>
                                    </td>
                                </tr>
                                
                                <?php }?>
                                </table>
                        </div>
                     </div>
                </div>
            
        <!-- CONTENT-WRAPPER SECTION END-->
                            
    
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">التواصل مع الطالب  </h1>
                    </div>
                </div>
                <div class="row" >
            
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                   <select id="filter-by-class">
                   
                   
                   <option>أختر الصف/الشعبة</option>
                   

                   <?php  foreach($classes as $c) { ?>

                    <option  value="<?php echo $c['id'] ?>" >
                    
                    <?php echo $c['className']. ' '.$c['numOfSection'] ?>
                    </option>
                 
                 <?php } ?>

                   </select>


                    <div class="panel panel-default">
                    <div class="panel-heading">
                        اسم الطالب  
                        </div>  
                      

                            <table class="table" id="student-table">
                              
                                <?php foreach($students as $student){ ?>
                                <tr  data-class-id="<?php echo $student['section_id'] ?>" >
                                    <td>
                                        <a href="StartChat.php?type=s&id=<?php echo $student['id'] ?>"> <?php echo $student['full_name'] ?></a>
                                    </td>
                                    <td>
                                    <?php  echo $student['className']?>
                                    </td>
                                </tr>
                                
                                <?php }?>
                            </table>
                            </table>
                                </div>
                        </div>
                    </div>
                     <!--  End  Bordered Table  -->
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

    <script>
    
    $(document).ready(function($) {
    var rows = $('kk tr').each(function() {
        var row = $(this);
        var columns = row.children('td');

        row.data('name-chars', [
            columns.eq(0).html()[0].toUpperCase(),
            columns.eq(1).html()[0].toUpperCase(),
        ]);
    });

    $('#filter-by-class').change(function() {
        var class_id = $(this).val();

var  rows = $("#student-table > tbody > tr");
        rows.each(function() {
            var row = $(this);
            var id = row.data('class-id');

            console.log(id,class_id);


            if(     class_id ==  id) {
                row.show();
            }
            else {
                row.hide();
            }
        });
    });
});
    
    </script>
</body>
</html>
