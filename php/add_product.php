<?php
@include("../php/conn.php");
if (isset($_POST['publish'])) {

    $image_name = $_FILES["image"]["name"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $image_path = "img/" . $image_name;
    move_uploaded_file($image_tmp_name, '../'.$image_path);

    $TITLE = $_POST["title"];
    $PRICE = $_POST["price"];
    $CATEGORY = $_POST["category"];
    $query = "INSERT INTO products (image,title,price,category) VALUES ('$image_path','$TITLE','$PRICE','$CATEGORY')";
    $query_run = mysqli_query($conn, $query);
}


header("location:../pages/admin.php");
