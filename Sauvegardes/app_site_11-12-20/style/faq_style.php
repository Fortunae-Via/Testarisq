<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>

/*faq*/

div
{
    margin-top: 25px;
    margin-bottom: 25px;
    margin-left: 50px;
    margin-right: 50px;
    text-align: center;
    padding: 1px;
}
.topnav {
  overflow: hidden;
  text-align: center;
}
.q1
{
    border-style: solid;
    border-radius:20px ;
    text-align: left;
    background-color: rgb(251, 255, 255);
}
p:hover{color:#3388BB;}
p2
{
    color:#3388BB;
}
p1
{
    color: #ffffff;
    font-size: 110%;
}
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    width: 800px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
    overflow: auto;
}

.dropdown:hover .dropdown-content {
    display: block;
}