<a href="?page=home"> Home </a> <br>
<h1> Confirmation </h1>

<?php
if( isset($_GET['topic_id'])){
    $topic_id=($_GET['topic_id']);   
}

if( isset($_GET['cat_id'])){
    $cat_id=$_GET['cat_id'];
}

if(isset($_GET["topic_close"])){
    $topic_closed=$_GET["topic_close"];
}

$html_confirm="";

if( isset( $_SESSION["user"] ) ){                                                        
    if ($_SESSION["user"]["id_role"]==1
    && $topic_closed==0){
        $html_confirm .= '<a> Attention :  Tous les posts associés seront supprimés !</a>';
    $html_confirm .= '<br><a href="?service=delete_topic&cat_id=' . $cat_id . '&topic_id=' . $topic_id . '" > Confirmer la suppression de ce sujet </a>';
    
    }
    echo $html_confirm;
}
else{
    die;
}
    
?>
