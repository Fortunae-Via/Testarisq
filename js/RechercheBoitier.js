function TransformerChamp(id) {

	// ===== CASE NOM  =====

	//On note la case du nom
	var AutRes = document.getElementById('NomAutRes'+id);

	//On crée le formulaire
	var Form = document.createElement("form");
	Form.setAttribute ("method","post");
	Form.setAttribute ("action","GestionBoitiers");
	var NomForm="form_modif_aut_res"+id;
	Form.setAttribute ("id",NomForm);

	//On crée un input caché pour le numero du boitier
	var HiddenInput = document.createElement("input");
	HiddenInput.setAttribute ("type","hidden");
	HiddenInput.setAttribute ("name","id_boitier");
	HiddenInput.setAttribute ("id","id_boitier");
	HiddenInput.setAttribute ("value",id);
	Form.append(HiddenInput);

	//On crée un select
	var Select = document.createElement("select");
	Select.setAttribute ("name","modif_aut_res");
	Select.setAttribute ("required","1");

	//On récupère les options du select du haut
	var SelectHaut = document.getElementById("aut_res");
	var OptionsSelectHaut = SelectHaut.getElementsByTagName("option");

	//On remplit le nouveau select avec les options, en sélectionnant par défaut celle qui correspond à la case d'avant
	for (var i = 1; i <= SelectHaut.length; i++) {
		var Option = document.createElement("option");
		var OptionReference = OptionsSelectHaut[i-1];

		if (OptionReference.innerText==AutRes.innerText){
			Option.setAttribute ("selected","1");
		}
		Option.setAttribute ("value",OptionReference.value);
		Option.innerHTML=OptionReference.innerHTML;
		Select.append(Option);
	}

	Form.append(Select);

	//On vide le dropdown
	AutRes.innerHTML = "";
	//On y ajoute le form
	AutRes.append(Form);


	// ===== CASE NOM  =====
	var OptionsAutRes = document.getElementById('OptionsAutRes'+id);
	OptionsAutRes.innerHTML='<button form="'+NomForm+'"type="submit">Soumettre la modification</button>';




}

