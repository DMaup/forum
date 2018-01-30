<?php 
       
if( isset( $_POST["post_title"] )
    && isset( $_POST["post_text"] )
    && isset( $_POST["post_topic"] )
    && isset( $_GET["topic_id"] )){

    $post_title = $_POST["post_title"];
    $post_text = $_POST["post_text"];
    $post_topic = $_POST["post_topic"];
    $topic_id = $_GET["topic_id"];
    
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
            "post_topic" => $topic_id
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

header("Location: ?page=posts&topic_id=".$topic_id."&message=". $message);