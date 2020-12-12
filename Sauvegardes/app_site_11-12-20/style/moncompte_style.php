<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>


#didi{
    position: relative;
    padding-top: 40px;
    border-top: 3px solid #ededed;
}
#sect{
	margin-bottom: 1rem;
	width: 50rem;
	padding: 0 2rem 0rem 2rem ;
	background-color: white;
	border-radius: 1rem;
	margin: 2rem 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);    
    
    border-radius: 1.5% 1.5%;
    background-color: #fefefe;
    
}

h3{
	margin-top: 2em;
	color: white; 
	text-align: center;
	font-weight: 300;
	font-size: 1rem
    /*position: absolute;
    top: 25%;
    left: 50%;
    transform: translate(-50%, -50%);   
    color: white;*/
}

@media only screen and (max-width:800px) {
 body {
 background-color:red;
 color:white
 }
}
