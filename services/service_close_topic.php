<?php 
if( isset($_GET["topic_id"])){
    $id = $_GET["topic_id"];
    
    if( closeTopicById( $id ) ){
        
        $message = "Sujet fermé !";
    }

    else {
        $message = "Erreur lors de la fermeture";
    }

    if( isset($_GET["cat_id"]) ){
        $cat_id = $_GET["cat_id"];        
    }
      
    header("Location: ?page=topics&topic_status=$topic_status&cat_id=$cat_id&topic_id=$topic_id&message=".$message);
    die();
}

else {
    header("Location: ?page=home");
    die();
}