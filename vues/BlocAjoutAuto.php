<form method="post">

	<p class="indication">Les champs indiqués d'une étoile sont obligatoires.</p>

	<div class="ligne">
		<div class="info">
			<label for="Nom">Nom <strong>*</strong>  :</label>
		</div>
		<input name="Nom" placeholder="Nom" required/>
	</div>
	
	<div class="ligne boutons">
		<div class="info">
			<label for="Type">Type de compte<strong>*</strong> :</label>
		</div>
		<div class="bloc_boutons">
			<input type="radio" id="police" name="Type" value="POL" required/>
			<label for="police">Agent de Police</label>
			<input type="radio" id="school" name="Type" value="AUE" required/>
			<label for="school">Auto-école</label>
		</div>
	</div>

	<div class="ligne">
    	<div class="info">
    		<label for="adresse">Adresse :</label>
    	</div>
    	<div class="special_size_inputs">
    		<input maxlength="4" id="numeroRue" name="numeroRue" placeholder="N°"/>
    		<input maxlength="100" id="rue" name="rue" placeholder="Rue"/>
    		<input maxlength="60" id="ville" name="ville" placeholder="Ville"/><br/>
    		<input maxlength="25" id="code" name="code" placeholder="Code Postal" />
    		<select name="region">
    			<option value="">Région</option>
    			<?php Region($bdd); ?>
    		</select>
    		<input maxlength="25" id="pays" name="pays" placeholder="Pays"/>
    	</div>
    </div>
    <div class="bloc_add">
    	<button id="add" type="submit">Ajouter Autorité</button>
    </div>
		

	
</form>