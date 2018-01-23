<?php 

if( 
    isset( $_POST["new_firstname"] )
    && isset( $_POST["new_password"] )){

    $new_firstname = $_POST["new_firstname"];
    $new_password = $_POST["new_password"];
    
    $_SESSION["fields"] = $_POST;
    debug($_POST);
    //Check new_firstname
    if( strlen( $new_firstname ) < 3 || strlen( $new_firstname ) > 16 ){
        $message = "16 caractères maximum !";
        $_SESSION["fields"]["new_firstname"] = "";
    }

    //Check password
    else if( strlen( $new_password ) < 6 || strlen( $new_password ) > 16 ){
        $message = "de 6 à 16 caractères requis !";
        $_SESSION["fields"]["new_password"] = "";
    }

    // All ok
    else {

        $new_user = [
            "new_firstname" => $new_firstname,
            "new_password" => $new_password,
            
        ];

        if( createProduct( $new_user ) ){
            $message = "Votre compte a bien été créé !";
            unset( $_SESSION["fields"] );
        }
        else {
            $message = "Une erreur est survenue lors de l'inscrition.";
        }

    }

}
else {
    $message = "Il manque des données !";
}

header("Location: ?page=admin&message=". $message);