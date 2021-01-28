function validateForm() {
	var nir = document.forms["form_ajout"]["id"].value;
	var tel = document.forms["form_ajout"]["telephone"].value;
	var emailID = document.form_ajout.mail.value;

	if(nir.length!=13) {
		alert("NIR incorrect");
		document.form_ajout.id.focus();
		return false;
	}
	if(tel!=""){
		if(tel.length!=10){
		alert("Numéro de telephone incomplet");
		document.form_ajout.telephone.focus();
		return false;
		}
	}
	positionArobase = emailID.indexOf("@");
	positionPoint = emailID.lastIndexOf(".");
	if (atpos < 1 || ( positionPoint - positionArobase < 2 )) {
		alert("Adresse Email Incorrect")
		document.form_ajout.mail.focus();
		return false;
	}
}