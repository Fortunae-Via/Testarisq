<form method="post">

	<div class="partie boitier">

		<h3>Autorité responsable <small>(si le boîtier a été attribué)</small> :</h3>

		<div class="ligne" id="ligneAutRes">

			<div class="nom">
				<label class="label_info" for="aut_res">Nom :</label>
				<div class="special_size_inputs">
					<select id="aut_res" name="aut_res">
						<option value="0" selected>Non spécifié</option>
						<?php
						foreach ($ListeAutoritesResponsablesPOL as $AutResPOL) {
							echo"<option class='POL' value=\"". $AutResPOL['id'] ."\">" . $AutResPOL['nom'] . "</option>";
						}
						foreach ($ListeAutoritesResponsablesAUE as $AutResAUE) {
							echo"<option class='AUE' value=\"". $AutResAUE['id'] ."\">" . $AutResAUE['nom'] . "</option>";
						}
						?>
					</select>
				</div>
			</div>

			<div class="filtres">
				<div class="ligne boutons">
					<label class="label_info" for="type_aut">Filtre :</label>
					<div class="bloc_boutons">
						<input type="radio" id="none" name="type_aut" checked/>
						<label for="none">Aucun</label>
						<input type="radio" id="police" name="type_aut" />
						<label for="police">Unité de Police</label>
						<input type="radio" id="school" name="type_aut" />
						<label for="school">Auto-école</label>
					</div>
				</div>
			</div>

		</div>

	</div>


	<?php 
	foreach ($ListeCapteurs as $ligne) {
		AfficherTypeCapteur($ligne);
	}
	?>


    <div class="bloc_add">
    	<button id="add" type="submit">Ajouter le boîtier</button>
    </div>

</form>