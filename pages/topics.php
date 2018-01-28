<?php
if( isset($_GET["message"]) ){
    echo "<div class='message'>" . $_GET["message"] . "</div>";

}

?>

<a href="?page=home"> Home </a> <br>
Catégorie :
<?php 
if( isset($_POST['cat_title'])){
    $cat_title=($_POST['cat_title']);
    echo $cat_title;
}
if( isset($_POST['cat_id'])){
        $cat_id=($_POST['cat_id']);
        
}
else $cat_id='cat_id';

?>
<br>
<div id="topics">
<?php 
     $index_page = 0;
    if( isset( $_GET["index_page"] ) ){
        $index_page = $_GET["index_page"];
    }
?>
<?php 
    $topics = getTopicsByCat($cat_id);
    
    if( count($topics) ){
        $html_topic="";
        foreach( $topics as $key => $topic ) {

            $html_topic .= '<form action="?page=posts" method="POST">';         
                    
                $html_topic .= '<div type="hidden" style="border: 1px solid black; margin: 5px;">';
                $html_topic .= '<h4>Auteur:  ' . $topic["writer"] . '</h4>';  
                $html_topic .= '<h4>Date de création:  ' . $topic["date"] . '</h4>';             
                $html_topic .= '<h4>' . $topic["label"] . '</h4>';
                $html_topic .= '<input type="hidden" name="topic_id" value=' . $topic["topic_id"] . '>';
                $html_topic .= '<input type="submit" value="Lire les posts">';
                $html_topic .= '</div>';   
        
            $html_topic .= '</form>';
        }
        
        echo $html_topic;

        
    }
    else {
        echo "<div> Aucun sujet ! </div>";
    }
        $html_new_topic="";    
        $html_new_topic .= '<form action="?page=new_topic" method="POST">';
        $html_new_topic .= '<input type="hidden" name="cat_id" value=' . $cat_id . '>';
        $html_new_topic .= '<input type="submit" value="Créer un sujet">';
        $html_new_topic .= '</form>';

        echo $html_new_topic;
    ?>
    Nombre de sujet(s) dans la catégorie  : <?php echo sizeof($topics) ?>
</div>