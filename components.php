


<script>
    function incrementValue(inputId, priceId, originalPrice) {
	var inputElem, priceElem, x, originalPrice;
		inputElem = document.getElementById(inputId, priceId);
		priceElem = document.getElementById(priceId);
		x = +inputElem.value;
	
	if(!isNaN(x)) {
	
		if(x < 1) {
			x = 1;
		}
		
		x++;
		inputElem.value = x;
		priceElem.innerText = (+originalPrice * x).toFixed(2);
		
	}else{
		inputElem.value = 1;
		priceElem.innerText = originalPrice;
	}
	
	totalPrice();
}


function decrementValue(inputId, priceId, originalPrice) {
	var inputElem, priceElem, x, originalPrice;
		inputElem = document.getElementById(inputId, priceId);
		priceElem = document.getElementById(priceId);
		x = +inputElem.value;
		
	if(!isNaN(x)) {
		x--;
	
		if(x < 1) {
			x = 1;
		}
		
		inputElem.value = x;
		priceElem.innerText = (+originalPrice * x).toFixed(2);
		
	}else{
		inputElem.value = 1;
		priceElem.innerText = originalPrice;
	}
	
	totalPrice();
}


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




<?php

function component($productname, $productprice,$productid){

    $element =  <<<_list
    <div class="shop-item">
    <form action="product.php" method="post">
                <img class="shop-item-image" src="./HTB100DwetzJ8KJjSspkq6zF7VXaH.jpg" width="30%" height="60%"  style="border-radius: 20px;" >
                <div class="shop-item-details">
                    <span class="shop-item-price">$productprice</span>
                    <button class="btn btn-light shop-item-button" name="add" type='submit'>+</button>
                    <input type='hidden' name='product_id' value='$productid'>
                </div>
                <span class="shop-item-title" style="color: gray;">$productname</span>
            
        </form>
        </div>
    _list;
    echo $element;

};


function cartElement($productimg, $productname, $productprice, $productid){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Seller: Hallel</small>
                                <h5 class=\"pt-2\">$$productprice</h5>
                                <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div class=\"text-center\">
                                    <button name=\"minus-btn\" id = \"minus-btn\" type=\"button\" class=\"btn minus-btn disabled bg-light border rounded-circle qty-down\" onclick=\"decrementValue('quantity$productid', 'price$productid', '$productprice')\"><i class=\"fas fa-minus\"></i></button>
                                    <input style=\"font-size: 12px;\" id = \"quantity$productid\" type=\"text\" value=\"1\" class=\"text-center form-control w-25 d-inline \">
                                    <button name\"plus-btn\"  id = \"plus-btn\" type=\"button\" class=\"btn plus-btn disabled bg-light border rounded-circle qty-up\" onclick=\"incrementValue('quantity$productid', 'price$productid', '$productprice')\"><i class=\"fas fa-plus\"></i></button>
                                    <p class=\"total-price\">
                                    <span><i class=\"fa fa-cedi\"></i></span>
                                    <span style=\"font-size: 12px;\">Computed Price: ₵<span class=\"price-container\" id=\"price$productid\">$productprice</span></span>
                                </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        <script type=\"text/javascript\" src=\"cart.js\"></script>
    
    ";
    echo  $element;

    
}


?>

