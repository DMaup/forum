<?php 
       
if( isset( $_POST["post_title"] )
    && isset( $_POST["post_text"] )
    && isset( $_POST["post_topic"] )){

    $post_title = $_POST["post_title"];
    $post_text = $_POST["post_text"];
    $post_topic = $_POST["post_topic"];
        
    $_SESSION["newpost"] = $_POST;
    
    
    
   
    //Check text
    if( strlen( $post_text ) < 10 || strlen( $post_text ) > 1000 ){
        $message = "Le texte doit contenir de 10 à 1000 caractères !";
        $_SESSION["newpost"]["new_post_text"] = "";        
    }

    // All ok
    else {

        $new_post = [
            "post_title" => $post_title,
            "post_text" => $post_text,
            "post_topic" => $post_topic
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

header("Location: ?page=home&message=". $message);