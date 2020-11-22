
<?php

session_start();

require_once ("CreateDb.php");
require_once ("components.php");
// require_once ('ajax/ip_address/index.php');

$db = new CreateDb("Productdb", "Producttb");

if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
  }
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

 <!-- Font Awesome -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

<!-- Bootstrap CDN -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!--offline bootstrap to be removed later-->
<!-- <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" /> -->


<!-- <link rel="stylesheet" href="style.css"> -->
<link rel="stylesheet" href="cart.css">



<style>
    .sec{
    background-color: transparent;
    border: 0;
    padding: 4px 8px;
    color: peru;
    font-size: 30px;
  }
</style>

</head>
<body>

<?php require_once ('header.php') ?>

<div class="container-fluid">
	<div class="row px-5">
        <div class="col-md-7">
            <div id="cart-items-container" class="shopping-cart">
                <h6>My Cart</h6>
                <hr>

                <?php
				    $total = 0;
                    if (isset($_SESSION['cart'])){
                        $product_id = array_column($_SESSION['cart'], 'product_id');

                        $result = $db->getData();
                        while ($row = mysqli_fetch_assoc($result)){
                            foreach ($product_id as $id){
                                if ($row['id'] == $id){
                                    cartElement($row['product_image'], $row['product_name'],$row['product_price'], $row['id']);
                                    $total = $total + (int)$row['product_price'];
                                }
                            }
                        }
                    }else{
                        echo "<h5>Cart is Empty</h5>";
                    }
				
                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

        <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6 >$<?php echo $total; ?></h6>
                        <h6 class="text-success">Depends on location</h6>
                        <hr>
                        <h6 id="amount-payable">$<?php
                            echo $total;
                            ?></h6>
                    </div>
                </div>
            </div>
				<a href="javascript:void(0)" id="button" class="button" onclick="showModal()">Confirm order</a>  
                <!-- Modal Section -->
                <div id="bg-modal" class="bg-modal" style="">
                    <div class="modal-contents">
                        <div class="close" onclick="document.getElementById('bg-modal').style.display = 'none';">+</div>
                        <form name="form" action="cart.php" method="POST" onsubmit ="validateForm()">
                            <label for ="fname">First Name</label>
							<input id="fname" name="fname" type="text" placeholder="First Name" required>
							
                            <label for ="lname">Last Name</label>
							<input id="lname" name="lname" type="text" placeholder="Last Name" required>
							
                            <label for ="number">Phone Number</label>
							<input id="number" name="number" type="tel" placeholder="Phone Number" required>
							
                            <label for = "email">Email Address</label>
							<input id="email" name="email" type = "email" placeholder = "email">
							
							<label for = "address">House Address</label>
							<input id="address" name="house-address" type = "text" placeholder = "Street name, House No." required>
							
                            <label for = "ddate">Delivery Date</label>
							<input id="ddate" name="ddate" type = "date" placeholder = "Delivery date" required>
							
							<input type="hidden" id="product-tracker" name="product-tracker" value="" />
							<input type="submit" class="order-btn" value="ORDER NOW" name="order" /> 
						</form>
                    </div>
                </div>
				
            </div>
		
        </div>
    </div>

	</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    



<script type="text/javascript" src="cart.js"></script>

<script src="ajax/js/index.js"></script>

<script>
	function showModal() {
		var productImage, productIdArray, productTracker;
			productIdArray = [];
			productTracker = document.getElementById('product-tracker');
			productImage = document.getElementsByClassName('product-image');
			
			for(var i = 0; i < productImage.length; i++) {
				productIdArray.push(productImage[i].getAttribute('data-id'));
			}
			
			productTracker.value = productIdArray.join(', ');
			
			document.getElementById('bg-modal').style.display = 'block';
		
	}
</script>


<script>
    function totalPrice() {
	var priceContainers, total, amountPayable, flatRate;
		amountPayable = document.getElementById('amount-payable');
		flatRate = document.getElementById('flat-rate');
		priceContainers = document.getElementsByClassName('price-container');
		total = 0;
	
	for(var i = 0; i < priceContainers.length; i++) {
		total += +priceContainers[i].innerText
	}
	
	amountPayable.innerHTML = '₵' + total.toFixed(2);
	flatRate.innerHTML = '₵' + (total + 10).toFixed(2);
}
</script>




</body>
</html>