<?php 

if( 
    isset( $_POST["topic_id"] )
    && isset( $_POST["topic_label"] )
     ){

    $topic_id = $_POST["topic_id"];
    $topic_label = $_POST["topic_label"];
    

    $_SESSION["newtopic"] = $_POST;
    
    //Check label
    if( strlen( $topic_label ) < 4 || strlen( $topic_label ) > 20 ){
        $message = "Le titre du sujet doit contenir de 4 à 20 caractères !";
        $_SESSION["newtopic"]["topic_label"] = "";
    }

    // All ok
    else {

        $new_topic = [
            "topic_id" => $topic_id,
            "topic_label" => $topic_label  
        ];
                
        if( createTopic( $new_topic ) ){
            $message = "Le sujet a bien été créé !";
            unset( $_SESSION["newtopic"] );
        }
        else {
            $message = "Une erreur est survenue lors de la création.";
        }

    }

}
else {
    $message = "Il manque des données !";
}

header("Location: ?page=topics&message=". $message);