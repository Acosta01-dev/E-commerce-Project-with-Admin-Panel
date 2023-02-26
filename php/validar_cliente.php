<?php if (!isset($_SESSION)) {
    session_start();
} ?>
<?php
@include("../php/conn.php");

$user = $_POST["user"];
$pass = $_POST["password"];

$query = "SELECT * FROM admin WHERE user='$user' AND password='$pass'";
$query_run = mysqli_query($conn, $query);

if (mysqli_fetch_assoc($query_run) > 0) {
    $_SESSION["user"] = $user;
    header("location:../pages/admin.php");
} else {
    header("location:../pages/admin.php?error_s");
}
?>