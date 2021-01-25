// On définit la fonction qui affiche ou masque en fonction
function ChoixListeAutRes2(Type) {
	if (Type == 'AUE') {
		document.getElementById('ligneAutResAUE2').style.display = 'flex';
		document.getElementById('ligneAutResPOL2').style.display = 'none';
		
	}
	else if (Type == 'POL'){
		document.getElementById('ligneAutResAUE2').style.display = 'none';
		document.getElementById('ligneAutResPOL2').style.display = 'flex';
	}
	else {
		document.getElementById('ligneAutResAUE2').style.display = 'none';
		document.getElementById('ligneAutResPOL2').style.display = 'none';
	}
}

var POLRadio2 = document.getElementById('police2');
var AUERadio2 = document.getElementById('school2');
var ADMRadio2 = document.getElementById('admin2');

POLRadio2.addEventListener('change', function(){
	if (POLRadio2.checked) {
		ChoixListeAutRes2('POL');
	}
});
AUERadio2.addEventListener('change', function(){
	if (AUERadio2.checked) {
		ChoixListeAutRes2('AUE');
	}
});
ADMRadio2.addEventListener('change', function(){
	if (ADMRadio2.checked) {
		ChoixListeAutRes2('ADM');
	}
});
