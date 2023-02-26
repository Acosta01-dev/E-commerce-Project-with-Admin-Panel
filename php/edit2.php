<?php
ob_start();

if (!isset($_SESSION)) {
    session_start();
}
@include("../php/conn.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT * FROM products WHERE id = $id";
    $query_run = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc(($query_run));
}

if (isset($_POST["edit"])) {

    if ($_FILES['image']['size']  > 0) {

        $image_name = $_FILES["image"]["name"];
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $image_path = "img/" . $image_name;
        move_uploaded_file($image_tmp_name, '../' . $image_path);

        $query = "UPDATE products SET image='$image_path' WHERE id = $id ";
        $query_run = mysqli_query($conn, $query);
    }

    $TITLE = $_POST["title"];
    $PRICE = $_POST["price"];
    $CATEGORY = $_POST["category"];
    $query = "UPDATE products SET title =  '$TITLE', price =  '$PRICE'  , category = '$CATEGORY' WHERE id = $id";
    $query_run = mysqli_query($conn, $query);

    header("location:../pages/admin.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Automotores Guamini</title>
    <!-- icon -->
    <link rel="icon" href="img/logo2.png" type="image/x-icon" />
    <!-- Font    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- Google Fonts Roboto -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <?php
    if (isset($_SESSION["user"])) {
        @include("../php/conn.php");
        $query = "SELECT * FROM products";
        $myquery_run = mysqli_query($conn, $query);
    ?>
        <form action="../php/edit2.php?id=<?php echo $_GET["id"] ?>" method="POST" enctype="multipart/form-data">

            <input type="text" value="<?php echo $row["title"] ?>" name="title" required placeholder="Title">
            <input type="text" value="<?php echo $row["price"] ?>" name="price" required placeholder="$ Price">


            <select id="category_form" name="category">
                <option value="Laptop">Laptop</option>
                <option value="Smartphone">Smartphone</option>
                <option value="Accessory">Accessory</option>
            </select>
            <input id="image" type="file" name="image" value='<?php echo $row["image"] ?>' />

            <img src="../<?php echo $row["image"] ?>">



            <input type="submit" value="Publish" name="edit">
        </form>

    <?php  } else {
        echo "Admin no conectado"; ?>


    <?php
    }
    ?>

    <main>

    </main>



</body>

</html>