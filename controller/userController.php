<?php
// Connecter un utilisateur
if (isset($_POST['btnLogin'])) 
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation de l'email et du mot de passe
    if(!(filter_var($email, FILTER_VALIDATE_EMAIL)) || (strlen($password) <8))
    {
      $error = "Email ou mot de passe incorrect.";
      header("Location:login?error=$error");  
    }
    else
    {
        // TO DO : Authentification utilisateur depuis la base de données
    
        header("Location:listeContacts");
    }


    // Ici, ajoutez la logique pour vérifier les informations d'identification de l'utilisateur
    // Par exemple, interroger la base de données pour valider l'email et le mot de passe

    // Si les informations sont correctes, démarrez une session et redirigez l'utilisateur
    // Sinon, affichez un message d'erreur
    

}


?>