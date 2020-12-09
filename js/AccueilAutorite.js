/************ Actualisation de l'heure ************/
function afficher_heure() {
	var heure_actuelle = new Date();
	var heures = heure_actuelle.getHours();
	var minutes = heure_actuelle.getMinutes();
    if (heures < 10) {heures = "0" + heures ;}
    if (minutes < 10) {minutes = "0" + minutes ;}
    document.getElementById("heure").innerHTML = heures +':'+ minutes; //on remplace le placeholder par l'heure mise en forme
} 

window.setInterval("afficher_heure()",1000); //On actualise toutes les secondes


/************ Actualisation du lieu ************/

function afficher_coordonnees(pos) {
  var coordonnees = pos.coords;
  var latitude = coordonnees.latitude;
  var longitude = coordonnees.longitude;
  var url_coords = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat="+ latitude + "&lon=" + longitude; //On écrit l'url personalisée en fonction des coordonnées

  /** Fonction pour récuperer du JSON **/
  var getJSON = function(url, callback) {
    var requete = new XMLHttpRequest();
    requete.open('GET', url, true);
    requete.responseType = 'json';
    
    requete.onload = function() {
        var status = requete.status;
        if (status == 200) {
            callback(null, requete.response);
        } else {
            callback(status);
        }
    };
    requete.send();
  };

  /** On récupère les données correspondantes aux coordonées**/
  getJSON(url_coords,  function(erreur, donnees_recuperees) {
      if (erreur != null) {
        console.error(erreur);
      } else {
        var ville = donnees_recuperees['address'].city
        document.getElementById("lieu").innerHTML = ville
      }
  });
}

navigator.geolocation.getCurrentPosition(afficher_coordonnees);
