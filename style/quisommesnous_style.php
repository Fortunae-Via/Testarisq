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

.content {
    border-radius: 0.5rem;
    background-color: white;
    padding: 1rem;
    text-align: justify;
    margin-bottom: 2rem;
}

.content img {
    max-width: 100%;
}

.content .liens{
    text-align: center;
    margin-top: 2rem;
    margin-bottom: 0;
}

.content a {
    text-decoration: none;
    color: #00A3B8;
}