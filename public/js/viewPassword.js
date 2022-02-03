function viewPassword(_this){
	var tipo = document.getElementById("password");
	if(tipo.type == "password"){
		tipo.type = "text";
	}else{
		tipo.type = "password";
	}
}

function viewConfirmPassword(_this){
	var tipo = document.getElementById("password-confirm");
	if(tipo.type == "password"){
		tipo.type = "text";
	}else{
		tipo.type = "password";
	}
}
