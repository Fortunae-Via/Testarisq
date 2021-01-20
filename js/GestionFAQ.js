function TransformerChamp(id) {

	//On note le dropdown dans lequel on agit
	var Drop = document.getElementById('drop'+id) ;

	//On met de côté la question et la réponse
	var Question = document.getElementsByClassName("question "+id)[0].getElementsByTagName("h3")[0].innerText;
	var Reponse = document.getElementById('p'+id).innerText ;

	//On crée le formulaire
	var Form = document.createElement("form");
	Form.setAttribute ("method","post");

	//On crée un input pour la question
	var InputQuestion = document.createElement("input");
	var NomId="modifquestion"+id;
	var Fonction="UpdateQuestion("+id+")";
	InputQuestion.setAttribute ("name","modifquestion");
	InputQuestion.setAttribute ("id",NomId);
	InputQuestion.setAttribute ("value",Question);
	InputQuestion.setAttribute ("oninput",Fonction);
	InputQuestion.setAttribute ("required","1");

	//On crée la text area
	var TextArea = document.createElement("textarea");
	TextArea.setAttribute ("name","modifreponse");
	TextArea.setAttribute ("rows","7");
	TextArea.setAttribute ("required","1");
	//On place la réponse dans la text area, en remplaçant les balises br par des retours à la ligne \n 
	TextArea.innerHTML=Reponse.replace(/<br\s*[\/]?>/gi, "\n");

	//On crée un input caché pour le numero de la question
	var HiddenInput = document.createElement("input");
	HiddenInput.setAttribute ("type","hidden");
	HiddenInput.setAttribute ("name","id_question");
	HiddenInput.setAttribute ("id","id_question");
	HiddenInput.setAttribute ("value",id);

	//On récupère le div bouton
	var BlocBouton = Drop.getElementsByClassName("bloc_boutons")[0];
	BlocBouton.innerHTML='<button id="bouton4" type="submit">Soumettre la modification</button>'; 

	//On place la text area et le div bouton dans le form
	Form.append(InputQuestion);
	Form.append(TextArea);
	Form.append(HiddenInput);
	Form.append(BlocBouton);

	//On vide le dropdown
	Drop.innerHTML = "";
	//On y ajoute le form
	Drop.append(Form);
}

function UpdateQuestion(id) {
	var QuestionBandeau = document.getElementsByClassName("question "+id)[0].getElementsByTagName("h3")[0];
	var ChampQuestion = document.getElementById('modifquestion'+id);

	QuestionBandeau.innerText = ChampQuestion.value;

}
