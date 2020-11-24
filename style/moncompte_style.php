<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>


#didi{
    position: relative;
    padding-top: 40px;
    border-top: 3px solid #ededed;
}
#sect{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);    
    
    border-radius: 1.5% 1.5%;
    background-color: #fefefe;
    padding: 2% 7% 2% 7%;
}

h3{
    position: absolute;
    top: 25%;
    left: 50%;
    transform: translate(-50%, -50%);   
    color: white;
}

@media only screen and (max-width:800px) {
 body {
 background-color:red;
 color:white
 }
}
