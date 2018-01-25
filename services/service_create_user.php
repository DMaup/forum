<?php 

if( 
    isset( $_POST["new_firstname"] )
    && isset( $_POST["new_password"] )){

    $new_firstname = $_POST["new_firstname"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    
    $_SESSION["fields"] = $_POST;
    
    //debug($_POST);
    //Check new_firstname
    if( strlen( $new_firstname ) < 3 || strlen( $new_firstname ) > 10 ){
        $message = "Le prénom doit contenir 3 à 10 caractères !";
        $_SESSION["fields"]["new_firstname"] = "";
                
    }
    
    //Check password
    else if( strlen( $new_password ) < 6 || strlen( $new_password ) > 16 ){
        $message = "Le mot de passe doit contenir de 6 à 16 caractères !";
        $_SESSION["fields"]["new_password"] = "";
    }

    else if( $confirm_password != $new_password ) {
        $message = "Les mots de passe sont différents !";
        $_SESSION["fields"]["new_password"] = "";
    }

    

    // All ok
    else {
        $new_password = sha1( $_POST["new_password"] . SALT );
        $new_user = [
            "new_firstname" => $new_firstname,
            "new_password" => $new_password
            
        ];
        //debug($new_user);

        if( createUSer( $new_user ) ){
            $message = "Votre compte a bien été créé !";
            unset( $_SESSION["fields"] );
            header("Location: ?page=home");
            break;
        }
        else {
            $message = "Une erreur est survenue lors de l'inscrition.";
            header("Location: ?page=inscription");
            break;
        }

    }

}
else {
    $message = "Champs incomplets !";
    header("Location: ?page=inscription");
    break;
}
header("Location: ?page=inscription&message=". $message);