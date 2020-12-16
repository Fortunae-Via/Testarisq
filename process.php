<?php
     $username = $_POST['user'];
     $password = $_POST['pass'];
     
     $username = stripclashes($username);
     $password = stripclashes($password);
     $username= mysql_real_escape_string($username);
     $password= mysql_real_escape_string($password);
     
     mysql_connect("localhost", "root", "");
     mysql_select_db("login");
     
     $result = mysql_query("SELECT * FROM users WHERE username = '$username' AND password = '$password'") or die("Nous n'avons pas réussi à trouver la base de donnée" mysql_error());
     $row= mysql_fetch_array($result);
     
     if($row['user']==$username AND $row['pass']==$pasword){
        echo "Bienvenue !";
     }
     else{
        echo "Echec de connexion";
     }    
?>