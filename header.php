<nav class="navbar navbar-expand-lg navbar-light navbar-survival101">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="./Screenshot 2020-11-05 at 3.56.52 PM.png" alt="L A N T E R N" width="180" height="110">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item " id="one">
          <a class="nav-link" href="./index.html">HOME</a>
        </li>
        <li class="nav-item" id="two">
          <a class="nav-link" href="./product.php">SHOP</a>
        </li>
        <li class="nav-item"  id="three">
          <a class="nav-link" href="form.html">CONTACT US</a>
        </li>
      </ul>
      <form class="form-inline">
      </form>
      <a href="./cart.php">
        <button class="sec" type="button" ><i class="fas fa-shopping-cart "></i> Cart</button>
        <?php

                        if (isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                            echo "<span id=\"cart_count\" class=\"text-warning bg-dark\">$count</span>";
                        }else{
                            echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
                        }

                        ?>
      </a>
    </div>
  </div>
</nav>
    