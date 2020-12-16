<?php header("Content-type: text/css"); ?>

/* Style commun à toutes les pages */
<?php include("style_commun.php"); ?>


*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    font-family: 'Montserrat';
}
section{
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.container{
    width: 90%;
    max-width: 500px;
    margin:80px;
    padding: 20px;
    box-shadow: 0px 0px 20px #00000010;
    background-color: white;
    border-radius: 8px;
    margin-bottom: 60px;
}
.form-group{
    width: 100%;
    margin-bottom: 20px;
    font-size: 20px;
}
.form-group input,
.form-group textarea{
    width: 100%;
    padding: 5px;
    font-size: 18px;
    border:1px solid rgba(128,128,128, 0.199);
    margin-top: 5px;
}
textarea{
    resize: vertical;
}
button[type="submit"]{
    width: 100%;
    border: none;
    outline: none;
    padding: 20px;
    font-size: 24px;
    border-radius: 8px;
    font-family: 'Montserrat';
    color: rgb(27, 166, 247);
    text-align: center;
    cursor: pointer;
    margin-top: 10px;
    transition: .3s ease background-color;
}
button[type="submit"]:hover{
    background-color: rgb(214, 226, 236);
}
#status{
    width: 90%;
    max-width: 500px;
    text-align: center;
    padding: 10px;
    margin: 0 auto;
    border-radius: 8px;
}
#status.réussir{
    background-color: rgb(211, 250, 153);
}
#status.erreur{
    background-color: rgb(250, 129, 92);
    color: white;
    animation: status 4s ease forwards;
}
@keyframes status{
  0%{
      opacity: 1;
      pointer-events: all;
  }
  90%{
    opacity: 1;
    pointer-events: all;
} 
100%{
    opacity: 0;
    pointer-events: none;
}     
