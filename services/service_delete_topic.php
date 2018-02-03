<?php 
if( isset($_GET["topic_id"])){
    $id = $_GET["topic_id"];
    
    if( deleteTopicById( $id ) ){
        $message = "Sujet supprimé !";
    }

    else {
        $message = "Erreur lors de la suppression";
    }

    if( isset($_GET["cat_id"]) ){
        $cat_id = $_GET["cat_id"];        
    }
    if( isset($_GET["topic_id"]) ){
        $topic_id = $_GET["topic_id"];        
    }
    
    header("Location: ?page=topics&cat_id=$cat_id&topic_id=$topic_id&message=".$message);
    die();
}

else {
    header("Location: ?page=home");
    die();
}