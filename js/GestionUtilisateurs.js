//


// On définit la fonction qui affiche ou masque en fonction
function ChoixListeAutRes(Type) {
	if (Type == 'AUE') {
		document.getElementById('ligneAutResAUE').style.display = 'flex';
		document.getElementById('ligneAutResPOL').style.display = 'none';
		
	}
	else if (Type == 'POL'){
		document.getElementById('ligneAutResAUE').style.display = 'none';
		document.getElementById('ligneAutResPOL').style.display = 'flex';
	}
	else {
		document.getElementById('ligneAutResAUE').style.display = 'none';
		document.getElementById('ligneAutResPOL').style.display = 'none';
	}
}

var CITRadio = document.getElementById('citizen');
var POLRadio = document.getElementById('police');
var AUERadio = document.getElementById('school');
var ADMRadio = document.getElementById('admin');

CITRadio.addEventListener('change', function(){
	if (CITRadio.checked) {
		ChoixListeAutRes('CIT');
	}
});
POLRadio.addEventListener('change', function(){
	if (POLRadio.checked) {
		ChoixListeAutRes('POL');
	}
});
AUERadio.addEventListener('change', function(){
	if (AUERadio.checked) {
		ChoixListeAutRes('AUE');
	}
});
ADMRadio.addEventListener('change', function(){
	if (ADMRadio.checked) {
		ChoixListeAutRes('ADM');
	}
});
