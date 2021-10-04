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
if(isset($_POST["s"]))
{	
    $nisreen= $_POST['class'];
    $mai= $_POST['subject'];


}
    
        
 if(isset($_POST["mai"]))
{	
    
    $class= $_POST['class'];
    $subject= $_POST['subject'];
     $host=$_SERVER['HTTP_HOST'];
     $extra="report.php?class=$class&subject=$subject";
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();

}
?>


<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>الغياب</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

   

<style>

.style1 {
	font-family: "Courier New";
	font-size: 30px;
	color: #FFFFFF;

}
.style2 {
	font-size: 24px;
	color: white;
}
.style7 {color: white}

.a {
    color: white;
   
}

</style>

<body >
<?php include('includes/header.php');?>
<a href="home.php"><b><button  style="position: absolute;
  left: 50px; top:30px; color:#6F479F; border: none; background-color:#e8e8e8;">العوده</button></b></a>

      <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">الغياب  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">

  <form  method="post" >

<table width="600"  border="1" align="center">
<tr>

        <td bordercolor="#330033" bgcolor="#6F479F"><h1 align="center"><strong><span class="style1"> الحضور والغياب</span></strong></h1></td>
  
      </tr>
      <tr>
        <td bgcolor="#e8e8e8" length="100"  >
        <div align="center">
       			<style type="text/css" >
	.menu{
      
		color: white;
		background-color: #6F479F;
		padding: 10px;
		font-size: 1.3em;
		text-decoration: none;
	}
	.menu:hover{
		background-color: #6F479F;
		padding: 10px;
		box-shadow: 5px 4px 5px 1px;
	}
</style>
<br>



<ul style="list-style:none;display:inline-block">
<li>
    
    <div  class="form-group" align="right" >
			<label for="class">الصف</label> 
            <select  id="class" name="class"  class="form-control">    

<?php
           $saa=mysqli_query($con,"select DISTINCT class from `addtable` where teacher='".$_SESSION['login']."' ");
                         while($da= mysqli_fetch_array($saa))
            {       
                          $class1=$da['class'];
                          $cl= mysqli_query($con,"select * from course where id = '$class1'");
                          $class= mysqli_fetch_array($cl);
   ?>
   <option value="" disabled selected hidden>اختر الصف </option>
    <option  value="<?php echo $class[0];?>">
                <?php echo $class[1]," ",$class[2]; ?>
            </option>
            <?php   }?>
        </select> 
</div>

</li>
<li>
<div  class="form-group" align="right" >
			<label for="subject">الماده</label> 
            <select  id="subject" name="subject"  class="form-control">    

<?php
           $saa=mysqli_query($con,"select DISTINCT subject from `addtable` where teacher='".$_SESSION['login']."' ");
                         while($d= mysqli_fetch_array($saa))
            {       
                          $subject1=$d['subject'];
                          $sl= mysqli_query($con,"select * from subject where id = '$subject1'");
                          $subject= mysqli_fetch_array($sl);
   ?>
   <option value="" disabled selected hidden>اختر الماده </option>
    <option  value="<?php echo $subject[0];?>">
                <?php echo $subject[1]; ?>
            </option>
            <?php   }?>
        </select> 
</div>
</li>

    
             
<br>
    <li> <button type="submit" name="s" style="float:center"  class="menu"> &nbsp;&nbsp;&nbsp;&nbsp;  ادخال الغياب &nbsp;&nbsp;&nbsp;&nbsp;</button></li> 
    <br> 
   
    <li><button   type="submit" name="mai" class="menu"> &nbsp;&nbsp;&nbsp;&nbsp;عرض معلومات الطلاب&nbsp;&nbsp;&nbsp;&nbsp;</button></li>
    
<br><br><br>
</ul>
</div> </td></tr>
 </table>
 </form>   
 </div>    </div>    </div>

<!-- ------------------------------------------------------------------------- -->
<form  method="post" action="getattendance1.php">

<script type="text/javascript">
	function getatt(value)
	{
		if(value == true)
		{
			document.getElementById("txtAbsent").value = parseInt(document.getElementById("txtAbsent").value) - 1;
			document.getElementById("txtPresent").value = parseInt(document.getElementById("txtPresent").value) + 1;
		}
		else
		{
			document.getElementById("txtAbsent").value = parseInt(document.getElementById("txtAbsent").value) + 1;
			document.getElementById("txtPresent").value = parseInt(document.getElementById("txtPresent").value) - 1;
		}
	}
</script>
       
<div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ادخال الحضور والغياب  
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                            <br>
        <form action="getattendance1.php" method="post">
        <table width="138px" align="center" style="background-color: darkgray; ">
            	<tr><td>
             
              <label for="class"  style="color:white;align=center" >اختر التاريخ:</label>  
                	  <br>
                    
                   <?php 
				 		    $dt = getdate();
							$day = $dt["mday"];
							$month = date("m");
							$year = $dt["year"];
							
							echo "<select name='cdate'>";
							for($a=1;$a<=31;$a++)
							{
								if($day == $a)
									echo "<option value='$a' selected='selected'>$a</option>";
								else
									echo "<option value='$a' >$a</option>";
							}
							echo "</select><select name='cmonth'>";
							for($a=1;$a<=12;$a++)
							{
								if($month == $a)
									echo "<option value='$a' selected='selected'>$a</option>";
								else
									echo "<option value='$a' >$a</option>";
							}
							echo "</select><select name='cyear'>";
							for($a=2010;$a<=$year;$a++)
							{
								if($year == $a)
									echo "<option value='$a' selected='selected'>$a</option>";
								else
									echo "<option value='$a' >$a</option>";
							}
							echo "</select>";
						?>                    
                    </td>
                </tr>
             </table>	
            
        <br>
      <table width="700" border="2" align="center" bordercolor="#9966FF" bgcolor="#C7B6B1" >
            <tr>
            <br>
              <td colspan="3" bgcolor="#6F479F"><div align="center"><strong><span class="style2">الحضور والغياب</span></strong></div></td>
            </tr>
            <tr bgcolor="darkgray">
              <td width="114"><span class="style7">رقم الطالب</span></td>
              <td width="152"><span class="style7">الاسم</span></td>
              <td width="110"><span class="style7">الحضور</span></td>
            </tr>

     <?php
                          

           $sql=mysqli_query($con,"SELECT DISTINCT * FROM `student` where  section_id='".$nisreen."' ");

           $s = 0;

           echo "<input  value= '".$nisreen."' name='class_id' hidden/>";
           echo "<input  value= '".$mai."' name='subject_id' hidden/>"; 


           while($rec = mysqli_fetch_array($sql))
           {
               $s = $s + 1;
               echo ' <tr>
                         <td width="114">'.$rec["id"].'</td>
                         <td width="152">'.$rec["first_name"].'  '.$rec["second_name"].'  '.$rec["third_name"].'  '.$rec["last_name"].'</td>
                         <td width="110"><input type=checkbox name='.$rec["id"].' onclick="getatt(this.checked);" checked/></td>
                       </tr>';
           }
			?>			

            <tr>
              <td colspan="3"><div align="center">
                <input type="submit" value="ادخال" name="btnsubmit"/>
                &nbsp;&nbsp;</div></td>
            </tr>
           
          </table>
          </form>
          <table width="100px" align="right" style="margin-left:35px">
            	<tr>
                	<td> مجموع الغياب <input type="text" id="txtAbsent" value="0" size="10" disabled="disabled"/></td>
                </tr>
                <tr>
                	<td> مجموع الحضور   <input type="text" id="txtPresent" value="<?php print $s; ?>" size="10"  disabled="disabled"/></td>
                </tr>
                <tr>
                	<td> عدد الطلاب  <input type="text" id="txtStrength" value="<?php print $s; ?>" size="10" disabled="disabled"/></td>
                </tr>
             </table>


   

    




    
   
    </div>
    </div>    </div>

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