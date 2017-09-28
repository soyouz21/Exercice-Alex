<?php
require ("./functions.php");//require est plus secure que include
$login = $_POST["login"];
$password = $_POST["password"];

if (isset($login)&& isset($password)){

    //3-Execution
    // 3.1 insertion dans la base de donnees

    try{
      // On se connecte à MySQL
      $bdd = new PDO('mysql:host=localhost;dbname=facedeBoock', 'root'   ,   'user');//je fais une connection à la base de données (à distance) qui s 'appele colyseum dont le user est root et mon mot de passe est user
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//permet d afficher les mess d erreurs
    }catch(Exception $e){
      // En cas d'erreur, on affiche un message et on arrête tout
      die('Erreur : '.$e->getMessage());//arrete tout
    }

    $requetePrepare=$bdd->prepare('INSERT INTO users(login,password)
    VALUES (?,?)');

    //je fais un insert dans la table users.
    //Sur la premiere ligne j ai les champs de la base de donnees et sur la 2 eme ligne j ai le svariables qui contiennent les noms qui vont etre remplacee par des valeurs grace a ma methode BINDVALUe ici bas,...

    $requetePrepare->execute(
      array(
        // "loginValue"=>$_POST["login"],
        // "passwordValue"=>$_POST["password"]
        // $_POST["login"],
        // $_POST["password"]
        $login, $password


    ));

    // 3.2 FIN: afficher message de bienvenue

    include ("views/messageHello.php");
  }


else{

  include ("./views/form.signup.php");

}


?>
