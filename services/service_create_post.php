<?php 

if( 
    isset( $_POST["post_title"] )
    && isset( $_POST["post_text"] )
     ){

    $post_title = $_POST["post_title"];
    $post_text = $_POST["post_text"];
    

    $_SESSION["newpost"] = $_POST;
    
    //Check title
    if( strlen( $post_title ) < 4 || strlen( $post_title ) > 20 ){
        $message = "Le titre doit contenir de 4 à 20 caractères !";
        $_SESSION["newpost"]["post_title"] = "";
    }

    //Check text
    else if( strlen( $post_text ) < 20 || strlen( $post_text ) > 1000 ){
        $message = "Le texte doit contenir de 4 à 1000 caractères !";
        $_SESSION["newpost"]["post_text"] = "";        
    }

    // All ok
    else {

        $new_post = [
            "post_title" => $post_title,
            "post_text" => $post_text  
        ];
       
        if( createPost( $new_post ) ){
            $message = "Le post a bien été ajouté !";
            unset( $_SESSION["newpost"] );
        }
        else {
            $message = "Une erreur est survenue lors de l'insertion.";
        }

    }

}
else {
    $message = "Il manque des données !";
}

header("Location: ?page=posts&message=". $message);