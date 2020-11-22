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

function validateForm(){
	const Form = document.forms['form'];
	const Fname = Form['fname']['value'];
	const Lname = Form['lname']['value'];
	const Num = Form['number']['value'];
	const Email = Form['email']['value'];
	const Hadress = Form['address']['value'];

		const emaiver = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if (!emaiver.test(Email)){
			alert("Please use the format: hi@example.com");
			return false;
		}
	
		const namever = /^[-\sa-zA-Z]+$/ ;
		if(!namever.test(Fname)){
			alert("Only letters and hyphens(-) allowed here");
			return false;
		}

		const namever = /^[-\sa-zA-Z]+$/ ;
		if(!namever.test(Lname)){
			alert("Only letters and hyphens(-) allowed here");
			return false;
		}

		const numver = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
		if(!numver.test(Num)){
			alert("Type a correct phone number");
			return false;
		}

		const hseadver = /^[0-9a-zA-Z]+$/;
		if(!hseadver.test(Hadress)){
			alert("Input your Street Name, House No.");
			return false;
		}

		else{
			return true;
		}

	
 
}