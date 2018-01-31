<?php 
if( isset($_GET['cat_id'])){
    $cat_id=$_GET['cat_id'];
}

if( isset($_GET['topic_label'])){
    $topic_label=$_GET['topic_label'];
}

if( isset( $_GET["post_id"] ) ){    
    $id = $_GET["post_id"];
    $text = $_POST["text"];
    $topic = $_GET["topic"];
    $error = false;
  
    //Check text
    if( strlen( $text ) < 10 || strlen( $text ) > 1000 ){
     
        $message = "Le texte doit contenir de 10 à 1000 caractères !";       
        $error = true;   
    }
   
    //Gestion si erreur ou pas
    if( $error ){      
        header("Location: ?page=edit_post&id=" . $id . "&message=" . $message);
        die();
    }
    
    else {
            $response = update_post( $text, $id);

            if( $response > 0 ) {
                $message = "Le post a été mis à jour";
            }

            else if( $response = 0 ){
                $message = "Aucun changement ou post non trouvé";
            }
    
            header("Location: ?page=posts&cat_id=" . $cat_id . "&topic_label=$topic_label&topic_id=" . $topic . "&message=" . $message);
            die();
    }    
}

else {
    header("Location: ?page=home");
    die();
}