<form method="post">

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

	<div class="ligne">
		<div class="info">
			<label for="id">NIR<strong>*</strong> :</label>
		</div>
		<input name="id" placeholder="xxxxxxxxxxxxx" required/>
	</div>

	<div class="ligne">
		<div class="info">
			<label for="nom">Nom de famille<strong>*</strong>  :</label>
		</div>
		<input name="nom" placeholder="Nom" required/>
	</div>

	<div class="ligne">
		<div class="info">
			<label for="nom_usage">Nom d'usage:</label>
		</div>
		<input name="nom_usage" placeholder="Nom d'usage"/>
	</div>

	<div class="ligne">
		<div class="info">
			<label for="surname">Prénoms<strong>*</strong> :</label>
		</div>
		<div class="special_size_inputs">
			<p>
				<input maxlength="12" id="prenom" name="prenom" placeholder="Prénom*" required/>
				<input maxlength="12" id="prenom_2" name="prenom_2" placeholder="2ème Prénom" />
				<input maxlength="12" id="prenom_3" name="prenom_3" placeholder="3ème Prénom"/>
			</p>
		</div>
	</div>

	<div class="ligne">
		<div class="info">
			<label for="birthdate">Date de naissance<strong>*</strong> :</label>
		</div>
		<div class="special_size_inputs">
			<p>	
				<select name="jour">
					<?php
					for($i=1; $i<=31; $i++){
						echo"<option value=\"". $i ."\">" . $i . "</option>";
					}
					?>
				</select>
				/
				<select name="mois">
					<option value="1">Jan.</option>
					<option value="2">Fév.</option>
					<option value="3">Mars</option>
					<option value="4">Avril</option>
					<option value="5">Mai</option>
					<option value="6">Juin</option>
					<option value="7">Juil.</option>
					<option value="8">Août</option>
					<option value="9">Sept.</option>
					<option value="10">Oct.</option>
					<option value="11">Nov.</option>
					<option value="12">Déc.</option></select>
				</select>
				/
				<select name="annee">
					<?php
					for($i=date("Y"); $i>=1900; $i--){
						echo'<option value="'. $i .'">'. $i .'</option>';
					}
					?>
				</select>
			</p>
		</div>
	</div>

	<div class="ligne boutons">
		<div class="info">
			<label for="sexe">Sexe<strong>*</strong>  :</label>
		</div>
		<div class="bloc_boutons">
			<input type="radio" id="Homme" name="sexe" value="Homme" required/>
			<label for="Homme">Homme</label>
			<input type="radio" id="Femme" name="sexe" value="Femme" required/>
			<label for="Femme">Femme</label>
			<input type="radio" id="Autre" name="sexe" value="Autre" required/>
			<label for="Autre">Autre</label>
			<input type="radio" id="Non-precise" name="sexe" value="Non-precise" required/>
			<label for="Non-precise">Non-précisé</label>
        </div>	
    </div>

    <div class="ligne">
    	<div class="info">
    		<label for="mail">Courriel<strong>*</strong>  :</label>
    	</div>
    	<input type="mail"name="mail" placeholder="xx@xx.xx" required/><br/>
    </div>

    <div class="ligne">
    	<div class="info">
    		<label for="adresse">Adresse :</label>
    	</div>
    	<div class="special_size_inputs">
    		<input maxlength="4" id="numeroRue" name="numeroRue" placeholder="N°"/>
    		<input maxlength="20" id="rue" name="rue" placeholder="Rue"/>
    		<input maxlength="12" id="ville" name="ville" placeholder="Ville"/><br/>
    		<input maxlength="6" id="code" name="code" placeholder="Code Postal" />
    		<select name="region">
    			<option value="">Région</option>
    			<?php Region($bdd); ?>
    		</select>
    		<input maxlength="10" id="pays" name="pays" placeholder="Pays"/>
    	</div>
    </div>

    <div class="ligne">
    	<div class="info">
    		<label id="telephone" for="telephone">Téléphone portable :</label>
    	</div>
    	<div class="special_size_inputs">
    		<input type="tel" maxlength="10" id="telephone" name="telephone" placeholder="xxxxxxxxxx" /><br/>
    	</div>
    </div>

    <div class="bloc_add">
    	<button id="add" type="submit">Ajouter Utilisateur</button>
    </div>

</form>