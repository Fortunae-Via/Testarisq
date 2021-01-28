<form method="post" action="GestionUtilisateurs">

	<p class="indication">Les champs indiqués d'une étoile sont obligatoires.<br>
		<strong>Attention !</strong> Si vous ajoutez un compte à un utilisateur possédant déjà un compte professionnel, le nouveau compte créé remplacera définitivement l'ancien.</p>

	<div class="ligne">
		<div class="info">
			<label for="nir2">NIR<strong>*</strong> :</label>
		</div>
		<input name="nir2" placeholder="xxxxxxxxxxxxx" required/>
	</div>
	
	<div class="ligne boutons">
		<div class="info">
			<label for="type_ajout_compte">Type de compte<strong>*</strong> :</label>
		</div>
		<div class="bloc_boutons">
			<input type="radio" id="police2" name="type_ajout_compte" value="POL" required/>
			<label for="police2">Agent de Police</label>
			<input type="radio" id="school2" name="type_ajout_compte" value="AUE" required/>
			<label for="school2">Auto-école</label>
			<input type="radio" id="admin2" name="type_ajout_compte" value="ADM" required/>
			<label for="admin2">Administrateur</label>
		</div>
	</div>

	<div>
		<div class="ligne" id="ligneAutResAUE2" style="display:none">
			<div class="info">
				<label for="aut_resAUE2">Nom de l'autorité responsable :</label>
			</div>
			<div class="special_size_inputs">
				<select name="aut_resAUE2">
					<option value="0" selected>Autorité responsable</option>
					<?php
					foreach ($ListeAutoritesResponsablesAUE as $AutResAUE) {
						echo"<option value=\"". $AutResAUE['id'] ."\">" . $AutResAUE['nom'] . "</option>";
					}
					?>
				</select>
			</div>
		</div>

		<div class="ligne" id="ligneAutResPOL2" style="display:none">
			<div class="info">
				<label for="aut_resPOL2">Nom de l'autorité responsable :</label>
			</div>
			<div class="special_size_inputs">
				<select name="aut_resPOL2">
					<option value="0" selected>Autorité responsable</option>
					<?php
					foreach ($ListeAutoritesResponsablesPOL as $AutResPOL) {
						echo"<option value=\"". $AutResPOL['id'] ."\">" . $AutResPOL['nom'] . "</option>";
					}
					?>
				</select>
			</div>
		</div>
	</div>

    <div class="bloc_add">
    	<button id="add" type="submit">Ajouter Compte</button>
    </div>

</form>