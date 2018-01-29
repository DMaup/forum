<?php 
if( isset( $_GET["post_id"] ) ){    
    $id = $_GET["post_id"];
    $text = $_POST["text"];
    $error = false;    

    //Check text
    if( strlen( $text ) < 10 || strlen( $text ) > 1000 ){
        $message = "Le texte doit contenir de 10 à 1000 caractères !";       
        $error = true;
    }

    //Gestion si erreur ou pas
    if( $error ){
        header("Location: ?page=edit_post&id=".$id."&message=".$message);
        die();
    }
    else {

        //$response;
        // if( $update_post ){

           
        //     $response = update_post( $id, $topic, $title, $date, $writer, $text );

            // if( $response > 0 ) {
            //     move_uploaded_file( $image["tmp_name"], "products_image/" . $image_name );
            //     $message = "Le post a été mis à jour";
            // }
            // else if( $response === 0 ) {
            //     $message = "Aucun changement ou post non trouvé";
            // }  
            // else {
            //     $message = "Erreur lors de la mise a jour";
            // }

        // }
        // else {

            $response = update_post( $text, $id);

            if( $response > 0 ) {
                $message = "Le post a été mis à jour";
            }
            else if( $response === 0 ){
                $message = "Aucun changement ou post non trouvé";
            }
            else {
                $message = "Erreur lors de la mise a jour";
            }

        }

        header("Location: ?page=home&message=".$message);
        die();

    
    
}
else {
    header("Location: ?page=home");
    die();
}