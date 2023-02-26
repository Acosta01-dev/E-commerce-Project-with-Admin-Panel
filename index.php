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
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div class="index__contenido">


    <header>

      <a href="index.php" class="header_logo">
        <i class="uil uil-shop"></i>
        <p>SHOP</p>
      </a>

      <form class="header_search" method="GET" action="index.php">
        <input type="text" name="query" placeholder="Search Here...">
        <button type="submit"><i class="uil uil-search-alt"></i></button>
      </form>


      <div class="header_icons">

        <i id="hamb_menu" class="uil uil-bars"></i>

        <i id="shopping_cart" class="uil uil-shopping-cart"></i>
        <i class="uil uil-bell"></i>
      </div>


    </header>
    <main class="container_main">

      <!--Section heading-->
      <h2 class="title">CATALOGO</h2>
      <div class="border"></div>




      <div class="main__productos">

        <?php
        @include("./php/conn.php");
        $query = "SELECT * FROM products";
        $myquery_run = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($myquery_run)) {
          if (isset($_GET['category'])) {
            $category = $_GET['category'];
            if ($category == $row['category']) {
              @include("./php/card.php");
            }
          } elseif (isset($_GET['query'])) {
          } //wont show up category results if you searched for something at the search bar. 
          else {
            @include("./php/card.php");
          }
        }

        if (isset($_GET['query'])) { //
          $query = $_GET['query'];

          $sql = "SELECT * FROM products WHERE title LIKE '%" . mysqli_real_escape_string($conn, $query) . "%'";
          $result = mysqli_query($conn, $sql);
          if (!$result) {
            die('Error: ' . mysqli_error($conn));
          }

          while ($row = mysqli_fetch_assoc($result)) {
            @include("./php/card.php");
          }
        }

        ?>







      </div>







    </main>
    <aside>

      <a href="index.php?category=Laptop">Laptops</a>
      <a href="index.php?category=Smartphone">Smartphones</a>
      <a href="index.php?category=Accessory">Accesories</a>
      <a href="index.php">All</a>

    </aside>
    <footer>

      <p>2023 Lorem ipsum dolor sit amet.
      </p>
      <div>
        <a href="#"> <i class="fa-brands fa-facebook"></i></a>
      </div>
    </footer>
  </div>
</body>

</html>