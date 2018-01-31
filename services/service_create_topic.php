<?php 

if( isset( $_POST["new_topic_label"] )
    && isset( $_POST["cat_id"] )){

    $new_topic_label = $_POST["new_topic_label"];
    $new_topic_cat = $_POST["cat_id"];
    
    $_SESSION["newtopic"] = $_POST;  
          
        //Check label
        if( strlen( $new_topic_label ) < 4 || strlen( $new_topic_label ) > 60 ){
            $message = "Le titre du sujet doit contenir de 4 à 60 caractères !";
            $_SESSION["newtopic"]["new_topic_label"] = "";
        }

        // All ok
        else {

            $new_topic = [
                "new_topic_label" => $new_topic_label,
                "cat_id" => $new_topic_cat    
            ];
                           
            if( $topic_id = createTopic( $new_topic ) ){
                $message = "Veuillez saisir le premier post associé";
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

header("Location: ?page=new_post&new_topic_label=" . $new_topic_label . "&cat_id=" . $new_topic_cat . "&topic_id=" . $topic_id . "&message=" . $message);
?>