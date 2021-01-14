<div class="div_page">
	<!-- Bloc d'ajout d'un utilisateur-->
	<div id="ajout" class="bloc">
		<button class="bandeau" onClick=" BasculerAffichage('dropdown1'); BasculerClasse('fleche1','fleche_expand','fleche_expand_down') ">
			<h3>Ajouter un utilisateur</h3>
			<img id="fleche1" class="fleche_expand_down" src="vues/img/expand.png" alt="fleche_expand"/>
		</button>

		<div id="dropdown1" class="dropdown-content" style="display: block;">
			<!-- Formulaire -->
			<form method="post">

				<!-- Type de compte -->
				<div class="ligne boutons">
					<div class="info">
						<label for="type_compte">Type de compte<strong>*</strong> :</label>
					</div>
					<div class="bloc_boutons">
						<input type="radio" id="citizen" name="type_compte" value="CIT"/>
						<label for="citizen">Citoyen</label>
						<input type="radio" id="police" name="type_compte" value="POL"/>
						<label for="police">Agent de Police</label>
						<input type="radio" id="school" name="type_compte" value="AUE"/>
						<label for="school">Auto-école</label>
						<input type="radio" id="admin" name="type_compte" value="ADM"/>
						<label for="admin">Administrateur</label>
					</div>
				</div>

				<!-- Identifiant -->
				<div class="ligne">
					<div class="info">
						<label for="id">NIR<strong>*</strong> :</label>
					</div>
					<input name="id" placeholder="xxxxxxxxxxxxx" />
				</div>

				<!-- Nom de famille -->
				<div class="ligne">
					<div class="info">
						<label for="nom">Nom de famille<strong>*</strong>  :</label>
					</div>
					<input name="nom" placeholder="Nom"/>
				</div>

				<!-- Nom d' usage -->
				<div class="ligne">
					<div class="info">
						<label for="nom_usage">Nom d'usage<strong>*</strong> :</label>
					</div>
					<input name="nom_usage" placeholder="Nom d'usage"/>
				</div>

				<!-- Prénoms -->
				<div class="ligne">
					<div class="info">
						<label for="surname">Prénoms<strong>*</strong> :</label>
					</div>
					<div class="special_size_inputs">
						<p>
							<input maxlength="12" id="prenom" name="prenom" placeholder="Prénom*"/>
							<input maxlength="12" id="prenom_2" name="prenom_2" placeholder="2ème Prénom" />
							<input maxlength="12" id="prenom_3" name="prenom_3" placeholder="3ème Prénom"/>
						</p>
					</div>
				</div>

				<!-- Date de Naissance JJ/MM/AAAA -->
				<div class="ligne">
					<div class="info">
						<label for="birthdate">Date de naissance<strong>*</strong> :</label>
					</div>
					<div class="special_size_inputs">
						<p>
							<input maxlength="2" id="jour" name="jour" placeholder="JJ"/> /
							<input maxlength="4" id="mois" name="mois" placeholder="MM" /> /
							<input maxlength="6" id="annee" name="annee" placeholder="AAAA" />
						</p>
					</div>
				</div>

				<!-- Sexe -->
				<div class="ligne boutons">
					<div class="info">
						<label for="sexe">Sexe<strong>*</strong>  :</label>
					</div>
					<div class="bloc_boutons">
						<input type="radio" id="Homme" name="sexe" value="Homme"/>
						<label for="Homme">Homme</label>
						<input type="radio" id="Femme" name="sexe" value="Femme"/>
						<label for="Femme">Femme</label>
						<input type="radio" id="Autre" name="sexe" value="Autre"/>
						<label for="Autre">Autre</label>
						<input type="radio" id="Non-precise" name="sexe" value="Non-precise" />
						<label for="Non-precise">Non-précisé</label>
		            </div>	
		        </div>

		        <!-- Courriel -->
		        <div class="ligne">
		        	<div class="info">
		        		<label for="mail">Courriel<strong>*</strong>  :</label>
		        	</div>
		        	<input name="mail" placeholder="xx@xx.xx"/><br/>
		        </div>

		        <!-- Adresse -->
		        <div class="ligne">
		        	<div class="info">
		        		<label for="adresse">Adresse<strong>*</strong> :</label>
		        	</div>
		        	<div class="special_size_inputs">
		        		<input maxlength="4" id="numeroRue" name="numeroRue" placeholder="N°"/>
		        		<input maxlength="20" id="rue" name="rue" placeholder="Rue"/>
		        		<input maxlength="12" id="ville" name="ville" placeholder="Ville"/><br/>
		        		<input maxlength="6" id="code" name="code" placeholder="Code Postal" />
		        		<select name="region">
		        			<option selected hidden>Région</option>
		        			<!--
		        			Appel de la fonction Region()
		        			Pour afficher les régions sélectionnables
		        			dans le formulaire
		        			 -->
		        			<?php Region($bdd); ?>
		        		</select>
		        		<input maxlength="10" id="pays" name="pays" value="France"/>
		        	</div>
		        </div>

		        <!-- Numéro de Téléphone -->
		        <div class="ligne">
		        	<div class="info">
		        		<label id="telephone" for="telephone">Téléphone portable<strong>*</strong>  :</label>
		        	</div>
		        	<div class="special_size_inputs">
		        		<input maxlength="10" id="telephone" name="telephone" placeholder="xxxxxxxxxx" /><br/>
		        	</div>
		        </div>

		        <!-- Bouton pour ajouter un utilisateur -->
		        <div class="bloc_add">
		        	<button id="add" type="submit">Ajouter Utilisateur</button>
		        </div>

		        <strong> (* obligatoire)</strong>
		    </form>
		</div>
	</div>

	<!-- Bloc de recherche d'un Utilisateur -->
	<div id="recherche" class="bloc">
		<button class="bandeau" onClick=" BasculerAffichage('dropdown2'); BasculerClasse('fleche2','fleche_expand','fleche_expand_down') ">
			<h3>Rechercher un utilisateur</h3>
			<img id="fleche2" class="fleche_expand" src="vues/img/expand.png" alt="fleche_expand"/>
		</button>
		<div id="dropdown2" class="dropdown-content" style="display: block;">
			<!-- Division principale de la page RechercheUtilisateur.php-->
			<div class="div_page">
				<section>
					<?php include("RechercheUtilisateur.php"); ?>
					</table>
				</section>
			</div>
		</div>
	</div>
</div>