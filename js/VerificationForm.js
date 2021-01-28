function validateFormAjout() {
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

function validateFormModifier() {
	var tel = document.forms["form_modif"]["telephone"].value;
	var emailID = document.form_modif.mail.value;

	if(tel!=""){
		if(tel.length!=10){
		alert("Numéro de telephone incomplet");
		document.form_modif.telephone.focus();
		return false;
		}
	}
	positionArobase = emailID.indexOf("@");
	positionPoint = emailID.lastIndexOf(".");
	if (atpos < 1 || ( positionPoint - positionArobase < 2 )) {
		alert("Adresse Email Incorrect")
		document.form_modif.mail.focus();
		return false;
	}
}

function validateFormCompte(){
	var nir2 = document.forms["form_compte"]["nir2"].value;
	if(nir2.length!=13) {
		alert("NIR incorrect");
		document.form_compte.nir2.focus();
		return false;
	}
}

/*function validateForm(form, id) {
	var tel = document.forms[form]["telephone"].value;
	var emailID = document.forms[form]["mail"].value;
	var nir = document.forms[form][id].value;

	if(nir.length!=13) {
		alert("NIR incorrect");
		document.forms[form][id].focus();
		return false;
	}
	if(tel!=""){
		if(tel.length!=10){
		alert("Numéro de telephone incomplet");
		document.forms[form]["telephone"].focus();
		return false;
		}
	}
	positionArobase = emailID.indexOf("@");
	positionPoint = emailID.lastIndexOf(".");
	if (atpos < 1 || ( positionPoint - positionArobase < 2 )) {
		alert("Adresse Email Incorrect")
		document.forms[form]["mail"].focus();
		return false;
	}
}*/