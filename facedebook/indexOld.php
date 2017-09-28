<?php
require ("./functions.php");//require est plus secure que include



if (isset($_POST["login"])&& isset($_POST["password"])){
  include ("views/donneeYes.php");
  //1-sanitisation,sert de bouclier afin d eviter de mettre par exemple du code js dans mon login, evite de pirater de serveur
  $email=sanitize($_POST["login"]);
  // echo $_POST["login"];
  // echo "email corrige: $email";
  //2-Validation
  // 2.1 verifier pour login adresse email valide@

  if (filter_var($email,FILTER_VALIDATE_EMAIL)){

    include("views/emailValide.php");

    // else{
    //   echo "email non valide";
    // }
    // // }


    // 2.2 pour mot de passe ne soit pas vide "empty"
    if (empty ($_POST["password"]) ==true){//si le champ vide est vrai cad si le champ n'est pas rempli

      include("views/donneesNo.php");
      // else {
      //   echo "votre login est ok";
      //     }




    //3-Execution
    // 3.1 insertion dans la base de donnees

    try{
      // On se connecte à MySQL
      $bdd = new PDO('mysql:host=localhost;dbname=facedeBoock;charset=utf8', 'root', 'user');//je fais une connection à la base de données (à distance) qui s 'appele colyseum dont le user est root et mon mot de passe est user
    }catch(Exception $e){
      // En cas d'erreur, on affiche un message et on arrête tout
      die('Erreur : '.$e->getMessage());//arrete tout
    }
    $requetePrepare=$bdd->prepare('INSERT INTO users(login,password)
    VALUES (:login,:password)');

    //je fais un insert dans la table users.
    //Sur la premiere ligne j ai les champs de la base de donnees et sur la 2 eme ligne j ai le svariables qui contiennent les noms qui vont etre remplacee par des valeurs grace a ma methode BINDVALUe ici bas,...



    $requetePrepare->bindValue(':login',$_POST["login"]);//lie une valeur
    $requetePrepare->bindValue(':password',$_POST["password"]);


    $requetePrepare->execute();



    // 3.2 FIN: afficher message de bienvenue

    include ("views/messageHello.php");
  }

}
else{
  echo "veuillez essayer à nouveau remplir les champs";
  include ("./views/form.signup.php");

}

}
?>
