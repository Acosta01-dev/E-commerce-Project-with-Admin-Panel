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

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="body_edit">

    <?php
    if (isset($_SESSION["user"])) {
        /*
        @include("../php/conn.php");
        $query = "SELECT * FROM products";
        $myquery_run = mysqli_query($conn, $query); 
        */

    ?>

        <form action="../php/edit.php?id=<?php echo $_GET["id"] ?>" method="POST" enctype="multipart/form-data">
            <div class="input_products">
                <label for="title">Title:</label>
                <input type="text" id='title' value="<?php echo $row["title"] ?>" name="title" required placeholder="Title">
                <label for="price">Price:</label>
                <input type="text" id='price' value="<?php echo $row["price"] ?>" name="price" required placeholder="$ Price">
                <label for="category_form">Category:</label>
                <?php echo '<select name="category">';
                $CATEGORY = array("Laptop", "Smartphone", "Accessory");
                foreach ($CATEGORY as $s) {
                    $sel = ($row["category"] == $s) ? 'selected = "selected"' : '';
                    echo '<option value="' . $s . '" ' . $sel . '>' . $s . '</option>';
                }
                echo '</select>';
                ?>
                <label for="image">Image:</label>
                <input id="image" type="file" name="image" /> <?php echo $row["image"] ?>
                <img style='width:30%' src="../<?php echo $row["image"] ?>">



                <input class='submit_button' type="submit" value="Save Edit!" name="edit">
            </div>


        </form>

    <?php  } else {
        echo "Admin no conectado"; ?>


    <?php
    }
    ?>
</body>

</html>