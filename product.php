<?php

// start session
session_start();

require_once ('CreateDb.php');
require_once ('components.php');


if (isset($_POST['add'])){
  //  print_r($_POST['product_id']);
  if(isset($_SESSION['cart'])){

      $item_array_id = array_column($_SESSION['cart'], "product_id");

      if(in_array($_POST['product_id'], $item_array_id)){
          echo "<script>alert('Product is already added in the cart..!')</script>";
          echo "<script>window.location = 'index.php'</script>";
      }else{

          $count = count($_SESSION['cart']);
          $item_array = array(
              'product_id' => $_POST['product_id']
          );

          $_SESSION['cart'][$count] = $item_array;
      }

  }else{

      $item_array = array(
              'product_id' => $_POST['product_id']
      );

      // Create new session variable
      $_SESSION['cart'][0] = $item_array;
      print_r($_SESSION['cart']);
  }
}



$database = new CreateDb("Productdb", "Producttb");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/75618b9696.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="product.css">



    <script src="./main.js" async></script>

</head>
<body>


<?php require_once ('header.php') ?>


<div class="main">
    <h2>Catalogue</h2>
    

    <div class="btn-group">
            <button type="button" class="active" id="btn1">Notebooks</button>
            <button type="button" data-filter=".stickers">Stickers</button>
            <button type="button" data-filter=".pencils">Pencils</button>
            <button type="button" data-filter=".gifts">Personalized Gifts</button>
            <button type="button" data-filter=".etc">etc</button>
    </div>

    <!-- try -->

    <section class=" content-section first"  id="mess">
        <?php 
        $result = $database->getData();
        while ($row = mysqli_fetch_assoc($result)){
            component($row['product_name'], $row['product_price'], $row['id']);
        }
        
        ?>
    </section>

    <!-- End -->


    <!-- <section class="container content-section" style="margin-left: 10%;">
        <h2 class="section-header">CART</h2>
        <div class="cart-row">
            <span class="cart-item cart-header cart-column">ITEM</span>
            <span class="cart-price cart-header cart-column">PRICE</span>
            <span class="cart-quantity cart-header cart-column">QUANTITY</span>
        </div>
        <div class="cart-items"></div>
        <div class="cart-total" id="cart">
            <strong class="cart-total-title">Total</strong>
            <span class="cart-total-price"></span>
        </div>
        <button class="btn btn-primary btn-purchase" type="button">PURCHASE</button>
    </section> -->


    <div class="cart-loop">
      
    </div>

</div>

<!-- <script>
      document.getElementById('mess').style.visibility = "hidden";
</script> -->


    <!-- <script src="./main.js"></script> -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
</body>
</html>