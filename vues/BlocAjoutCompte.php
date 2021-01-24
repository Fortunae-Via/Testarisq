<form method="post" action="GestionUtilisateurs">

	<p class="indication">Les champs indiqués d'une étoile sont obligatoires.</p>
	
	<div class="ligne boutons">
		<div class="info">
			<label for="type_compte">Type de compte<strong>*</strong> :</label>
		</div>
		<div class="bloc_boutons">
			<input type="radio" id="citizen" name="type_compte" value="CIT" required/>
			<label for="citizen">Citoyen</label>
			<input type="radio" id="police" name="type_compte" value="POL" required/>
			<label for="police">Agent de Police</label>
			<input type="radio" id="school" name="type_compte" value="AUE" required/>
			<label for="school">Auto-école</label>
			<input type="radio" id="admin" name="type_compte" value="ADM" required/>
			<label for="admin">Administrateur</label>
		</div>
	</div>

	<div>
		<div class="ligne" id="ligneAutResAUE" style="display:none">
			<div class="info">
				<label for="aut_resAUE">Nom de l'autorité responsable :</label>
			</div>
			<div class="special_size_inputs">
				<select name="aut_resAUE">
					<option value="0" selected>Autorité responsable</option>
					<?php
					foreach ($ListeAutoritesResponsablesAUE as $AutResAUE) {
						echo"<option value=\"". $AutResAUE['id'] ."\">" . $AutResAUE['nom'] . "</option>";
					}
					?>
				</select>
			</div>
		</div>

		<div class="ligne" id="ligneAutResPOL" style="display:none">
			<div class="info">
				<label for="aut_resPOL">Nom de l'autorité responsable :</label>
			</div>
			<div class="special_size_inputs">
				<select name="aut_resPOL">
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

	<div class="ligne">
		<div class="info">
			<label for="id">NIR<strong>*</strong> :</label>
		</div>
		<input name="id" placeholder="xxxxxxxxxxxxx" required/>
	</div>

    <div class="bloc_add">
    	<button id="add" type="submit">Ajouter Compte</button>
    </div>

</form>