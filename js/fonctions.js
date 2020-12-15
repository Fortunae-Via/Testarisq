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

