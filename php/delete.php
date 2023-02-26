<?php 
ob_start();

if(!isset($_SESSION)) {
    session_start();
}

@include("../php/conn.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "DELETE FROM products WHERE  id = $id";
}

if(isset($_SESSION["user"])){
$query_run = mysqli_query($conn, $query);
header("location:../pages/admin.php");
}
else{
    echo "Admin no conectado";
   
}

?>