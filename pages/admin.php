<?php

if (!isset($_SESSION)) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel</title>
  <!-- icon -->
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

<body class="body_edit">
  <?php
  if (isset($_SESSION["user"])) {
    @include("../php/conn.php");

    $query = "SELECT * FROM products ORDER BY id DESC";
    $myquery_run = mysqli_query($conn, $query);
  ?>


    <form action="../php/add_product.php" method="POST" enctype="multipart/form-data">
      <div class="input_products">
        <input type="text" name="title" required placeholder="Title">
        <input type="text" name="price" required placeholder="$ Price">
        <select id="category_form" name="category">
          <option value="Laptop">Laptop</option>
          <option value="Smartphone">Smartphone</option>
          <option value="Accessory">Accessory</option>
        </select>
        <input id="image" type="file" name="image" /><br>
        <input class='submit_button' id="publish_form" type="submit" value="Publish" name="publish">
      </div>

    </form>

    <?php
    while ($row = mysqli_fetch_assoc($myquery_run)) {  ?>
      <div class="admin_content">


        <div style="overflow-x:auto;">

          <table>
            <tr>
              <th>Product Image</th>
              <th>Product Title</th>
              <th>Product Price</th>
              <th>Product Category</th>
              <th>Edit</th>
              <th>Delete</th>

            </tr>
            <tr>
              <td><img class="img_table" src="../<?php echo $row["image"] ?>"> </td>
              <td><?php echo $row["title"] ?></td>
              <td><?php echo $row["price"] ?></td>
              <td><?php echo $row["category"] ?></td>

              <td><a id="edit" href="../php/edit.php?id=<?php echo $row["id"] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
              <td><a id="delete" href="../php/delete.php?id=<?php echo $row["id"] ?>"><i class="fa-solid fa-trash"></i></a></td>

          </table>
        </div>
      </div>
    <?php  } ?>
    <div>
      <br>
      <a id="logout" href="../php/logout.php">logout</a>
      <br>  <!--- TO DO NEXT : --->
      <br>  <!--- Avoid Y Scroll Bar --->
    </div>
  <?php  } else { ?>

    <div class="login_screen_background">
      <div class="login_screen">
        <img src="">  <!--- TO DO NEXT : ---> <!--- Profile Picture --->
        <form action="../php/validar_cliente.php" method="POST">
          <input class="user" type="text" name="user" required placeholder="User"> <!---Developer note: ---> <!--- User and Password are in the Admin table --->
          <input class="password" type="password" name="password" required placeholder="Password">
          <input type="submit" value="Log In">
        </form>
      </div>

    </div>
  <?php
  }
  ?>

  <main>

  </main>



</body>

</html>