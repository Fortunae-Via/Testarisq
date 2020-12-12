<?php header("Content-type: text/css"); ?>

.main-head{
    color: #ffffff;
    border-bottom: 2px white solid;
}

#logo_header{
    max-width: 10em;
    margin-left: 1em;
}

.main-head nav{
    min-height: 10vh;
    display: flex;
    align-items: center;
}

.main-head nav ul{
    margin-right: 1em;
    display: flex;
    flex: 1 1 40rem;
    justify-content: flex-end;
    align-items: center;
    list-style: none;
}

.main-head nav li{
    margin: 0 0.5em;
}

.main-head nav li a{
    display: block;
    text-decoration: none;
    color: #FFFFFF;
    font-size: 0.8em;
}

.main-head nav li :hover{
    color: #3388BB;
}
