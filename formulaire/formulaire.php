<?php
if(isset($_GET["email"])){
  echo "merci le champ n'est pas vide"."</br>";
$email=$_GET["email"];
  //verifier ici si l adresse est valide
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Cette $email adresse email est considérée comme valide.";
  }
  else {
      echo "Cette $email adresse email n'est pas considérée comme valide.";
  }

}
else{
  //echo "merci le champ est vide";
 header("location: index.html");//fonction qui permet de retourner vers l 'index.html'
}
?>
