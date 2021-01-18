<?php

    foreach ($faq as $key) {

        $id = $key['Id'];
        $drop = "drop".$id;
        $fleche = "fleche".$id;
        $rep = "rep".$id;
        $p = "p".$id;
        $bouton = "bouton".$id;
        $classequestion = "class=\""."question ".$id."\"";
?>
        
        <div <?=$classequestion?> >
            <button class="bandeau_question" onClick=" BasculerAffichage('<?=$drop?>'); BasculerClasse('<?=$fleche?>','fleche_expand','fleche_expand_down') ">
                <h3><?=$key['Question']?></h3>
                <img id=<?=$fleche?> class="fleche_expand" src="vues/img/expand.png" alt="fleche_expand"/>
            </button>
            <div id='<?=$drop?>' class="dropdown-content" style="display: none;">
                <div id='<?=$rep?>'>
                    <p id='<?=$p?>'><?=$key['Reponse']?></p>
                </div>
                <?php if($Modifications == true) {?>
                <div class="bloc_boutons">
                    <button id=<?=$bouton?> onClick="TransformerChamp('<?=$id?>')">Modifier</button>
                    <form method="post" onsubmit="return confirmation();" action="controleurs/SuppressionFAQ.php">
                        <input name="idsupp" value='<?=$id?>' type="hidden"/>
                        <button id="boutonsupp" type="submit">Supprimer</button>
                    </form>
                </div>
                <?php };?>
            </div>
        </div>
                       
<?php 
    }
?>