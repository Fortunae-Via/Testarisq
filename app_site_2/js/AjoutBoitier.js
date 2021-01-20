var Select = document.getElementById('aut_res');
var OptionsPOL = Select.getElementsByClassName("POL");
var OptionsAUE = Select.getElementsByClassName("AUE");


// On définit la fonction qui affiche ou masque en fonction
function AffichageChoixListeAutRes(Type) {
	if (Type == 'AUE') {
		for (var i = 0; i < OptionsAUE.length; i++) {
			OptionsAUE[i].style.display = "block";	
		}
		for (var i = 0; i < OptionsPOL.length; i++) {
			OptionsPOL[i].style.display = "none";	
		}
	}
	else if (Type == 'POL'){
		for (var i = 0; i < OptionsAUE.length; i++) {
			OptionsAUE[i].style.display = "none";	
		}
		for (var i = 0; i < OptionsPOL.length; i++) {
			OptionsPOL[i].style.display = "block";	
		}
	}
	else {
		for (var i = 0; i < OptionsAUE.length; i++) {
			OptionsAUE[i].style.display = "block";	
		}
		for (var i = 0; i < OptionsPOL.length; i++) {
			OptionsPOL[i].style.display = "block";	
		}
	}
}


var NoneRadio = document.getElementById('none');
var POLRadio = document.getElementById('police');
var AUERadio = document.getElementById('school');

NoneRadio.addEventListener('change', function(){
	if (NoneRadio.checked) {
		AffichageChoixListeAutRes('None');
	}
});
POLRadio.addEventListener('change', function(){
	if (POLRadio.checked) {
		AffichageChoixListeAutRes('POL');
	}
});
AUERadio.addEventListener('change', function(){
	if (AUERadio.checked) {
		AffichageChoixListeAutRes('AUE');
	}
});
