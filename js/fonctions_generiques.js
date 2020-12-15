function BasculerAffichage(element)
{
	var ElementABasculer = document.getElementById(element);
	if (ElementABasculer.style.display === "none") {
    	ElementABasculer.style.display = "block";
  	}
  	else {
   		ElementABasculer.style.display = "none";
  	}
}

function BasculerClasse(element, classe_1, classe_2)
{
	var ElementABasculer = document.getElementById(element);
	if (ElementABasculer.className===classe_1) {
		ElementABasculer.className=classe_2;
  	}
  	else {
  		ElementABasculer.className=classe_1;
  	}

}