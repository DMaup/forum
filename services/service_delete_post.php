<?php 
if( isset($_GET["id"]) ){

    $id = $_GET["id"];

    if( deletePostById( $id ) ){
        $message = "Post supprimé !";
    }
    else {
        $message = "Erreur lors de la suppression";
    }

    header("Location: ?page=home&message=".$message);
    die();

}
else {
    header("Location: ?page=home");
    die();
}