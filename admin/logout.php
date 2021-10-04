<?php
session_start();
$_SESSION['alogin']=="";
session_unset();
//session_destroy();

?>
<script language="javascript">
document.location="../index.php";
</script>
