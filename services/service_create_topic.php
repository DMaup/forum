<?php 

if( 
    isset( $_POST["new_topic_label"] )
    && isset( $_POST["cat_id"] )){

    $new_topic_label = $_POST["new_topic_label"];
    $new_topic_cat = $_POST["cat_id"];
    
    $_SESSION["newtopic"] = $_POST;     
   
    //Check label
    if( strlen( $new_topic_label ) < 4 || strlen( $new_topic_label ) > 60 ){
        $message = "Le titre du sujet doit contenir de 4 à 60 caractères !";
        $_SESSION["newtopic"]["new_topic_label"] = "";
    }

    // else if( strlen( $new_topic_description ) < 4 || strlen( $new_topic_description ) > 60 ){
    //     $message = "La descrition du sujet doit contenir de 4 à 60 caractères !";
    //     $_SESSION["newtopic"]["new_topic_description"] = "";
    // }

    // All ok
    else {

        $new_topic = [
            "new_topic_label" => $new_topic_label,
            // "new_topic_description" => $new_topic_description  
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

header("Location: ?page=home&message=". $message);