// On définit la fonction qui affiche ou masque en fonction
function ChoixListeAutRes1(Type) {
	if (Type == 'AUE') {
		document.getElementById('ligneAutResAUE1').style.display = 'flex';
		document.getElementById('ligneAutResPOL1').style.display = 'none';
		
	}
	else if (Type == 'POL'){
		document.getElementById('ligneAutResAUE1').style.display = 'none';
		document.getElementById('ligneAutResPOL1').style.display = 'flex';
	}
	else {
		document.getElementById('ligneAutResAUE1').style.display = 'none';
		document.getElementById('ligneAutResPOL1').style.display = 'none';
	}
}

var CITRadio1 = document.getElementById('citizen1');
var POLRadio1 = document.getElementById('police1');
var AUERadio1 = document.getElementById('school1');
var ADMRadio1 = document.getElementById('admin1');

CITRadio1.addEventListener('change', function(){
	if (CITRadio1.checked) {
		ChoixListeAutRes1('CIT');
	}
});
POLRadio1.addEventListener('change', function(){
	if (POLRadio1.checked) {
		ChoixListeAutRes1('POL');
	}
});
AUERadio1.addEventListener('change', function(){
	if (AUERadio1.checked) {
		ChoixListeAutRes1('AUE');
	}
});
ADMRadio1.addEventListener('change', function(){
	if (ADMRadio1.checked) {
		ChoixListeAutRes1('ADM');
	}
});
