<?php
if( isset($_GET["message"]) ){
    echo "<div class='message'>" . $_GET["message"] . "</div>";
}

if( isset($_GET['topic_id'])){
    $topic_id=($_GET['topic_id']);   
}

if( isset($_GET['cat_id'])){
    $cat_id=$_GET['cat_id'];
}

?>

<a href="?page=home"> Home </a> <br>

<?php 
    if( isset($_POST['cat_title'])){
        $cat_title=$_POST['cat_title'];
        echo $cat_title;    
    }
    
?>
<br>

<div id="topics">
<?php 
     $index_page = 0;
    if( isset( $_GET["index_page"] ) ){
        $index_page = $_GET["index_page"];
    }
    
    $topics = getTopicsByCat($cat_id);
    
    if( count($topics) ){
          
        $html_topic="";
        
        foreach( $topics as $key => $topic ) {
            $topic_id = $topic["topic_id"];
            
            $nb_posts = countPostsByTopic ($topic_id);
            
                if ($nb_posts >0){
             
            $html_topic .= '<form action="?page=posts&topic_closed=' . $topic["topic_closed"] . '&cat_id=' . $cat_id . '&topic_id=' . $topic_id . '" method="POST">';           
                $html_topic .= '<div type="hidden" style="border: 1px solid black; margin: 5px;">';
                $html_topic .= '<h4>' . $topic["label"] . '</h4>';
                $html_topic .= '<a>Nombre de post(s) dans ce sujet:  ' . $nb_posts . '</a>';
                $html_topic .= '<h4>Auteur:  ' . $topic["writer"] . '</h4>';  
                $html_topic .= '<h4>Date de création:  ' . $topic["date"] . '</h4>';             
                $html_topic .= '<input type="hidden" name="topic_id" value=' . $topic["topic_id"] . '>';
                $html_topic .= '<input( type="text" name="topic_closed" value=' . $topic["topic_closed"] . '>';
                if ($topic["topic_closed"]==1){
                $html_topic .= '<a>Sujet fermé !</a>'; 
                } 
                $html_topic .= '<input type="hidden" name="topic_label" value="' . $topic["label"] . '">';
                $html_topic .= '<input type="submit" value="Lire les posts">';
                $topic_closed=$topic["topic_closed"];
                if( isset( $_SESSION["user"] ) ){                                                        
                    if ($_SESSION["user"]["id_role"]==1
                    && $topic_closed==1){  
                $html_topic .= '<br><a href="?service=open_topic&cat_id=' . $cat_id . '&topic_id=' . $topic_id . '" > Ré-ouvrir ce sujet </a>';
                    }
                
                // if( isset( $_SESSION["user"] ) ){                                                        
                    if ($_SESSION["user"]["id_role"]==1
                    && $topic_closed==0){
                    $html_topic .= '<br><a href="?service=delete_topic&cat_id=' . $cat_id . '&topic_id=' . $topic_id . '" > Supprimer ce sujet </a>';
                    $html_topic .= '<a> Attention :  Tous les posts associés seront supprimés !</a>';
                    }
                    
                    if ($_SESSION["user"]["id_role"]==1
                    && $topic_closed==0){                        
                        $html_topic .= '<br><a href="?service=close_topic&cat_id=' . $cat_id . '&topic_id=' . $topic_id . '" > Fermer ce sujet </a>';
                        $html_topic .= '<a> Le sujet apparaitra en lecture seule !</a>';
                        }

                }
                $html_topic .= '</div>';   
        
            $html_topic .= '</form>';
                }
            
        }
        
        echo $html_topic;       
    }
    
    else {
        
        $message = "Aucun sujet dans cette catégorie !";
    
        header("Location: ?page=new_topic&cat_id=" . $cat_id . "&topic_id=" . $topic_id . "&message=" . $message);
        die();
    }
        $html_new_topic="";    
        $html_new_topic .= '<form action="?page=new_topic&cat_id=' . $cat_id . '&topic_id=' . $topic_id . '" method="POST">';
        // $html_new_topic .= '<input type="hidden" name="cat_id" value=' . $cat_id . '>';
        $html_new_topic .= '<input type="submit" value="Créer un sujet">';
        $html_new_topic .= '</form>';

        echo $html_new_topic;
    ?>
   
</div>