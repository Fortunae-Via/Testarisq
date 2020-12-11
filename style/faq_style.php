<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>

.div_page{
    width: 80%;
    margin: auto;
}

.div_page header {
    margin: 2rem;
    overflow: hidden;
    text-align: center;
    color: white;
    font-size: 1.2rem;
}

.bandeau_question {
    padding: 0.5rem 1rem ;
    padding-right: 0.4rem;
    background-color: white;
}

.bandeau_question h2 {
    font-size: 1.1rem;
    margin:0;
}

.bandeau_question h2:hover {
    color: #00A3B8;
}

/* On enlève tout le style par défaut des boutons */
button {
    display: inline-block;
    border: none;
    text-decoration: none;
    background: none;
    font: inherit;
    cursor: pointer;
    text-align: center;
}
button:hover,button:focus {
    background: none;
    outline: none
}
button:active {
    transform: scale(0.99);
}
/* On enlève tout le style par défaut des boutons */

button {
    float:right;
}

button img {
    height: 0.6rem;
}

.question {
    margin-bottom: 1rem;
}

.dropdown-content {
    display: none;
    background-color: #DEDEDE;
    margin:0;
    border-radius: 0 0 0.5rem 0.5rem;
    padding: 1rem;
    text-align: justify;
}

.question:hover .dropdown-content {
    display: block;
}

.div_page footer {
    margin-top: 2rem;
    text-align: center;
    color: white;
}

.div_page footer a {
    text-decoration: none;
    color: #00A3B8;
}

