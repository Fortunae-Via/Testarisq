<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>

.conteneur {
  display: flex;
  justify-content: space-between;
}

#boitier_1, #boitier_2 {
  width: 45%;
  background-color: white;
  margin-left: 2%;
  margin-right: 2%;
  margin-top:5%;
  padding: 1rem;
  border-radius: 50px;
}

h2, p {
  text-align: center;
}
