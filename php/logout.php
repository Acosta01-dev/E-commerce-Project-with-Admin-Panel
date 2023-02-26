<?php 
if(!isset($_SESSION)) {
    session_start();
}
session_destroy(); 

header("location:../pages/admin.php");
exit;

?>