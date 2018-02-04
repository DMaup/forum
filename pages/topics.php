<div class="container">
<?php
if( isset($_GET["message"]) ){
    echo "<p class='badge badge-success'>" . $_GET["message"] . "</p>";
}

if( isset($_GET['topic_id'])){
    $topic_id=($_GET['topic_id']);   
}

if( isset($_GET['cat_id'])){
    $cat_id=$_GET['cat_id'];
}

?>
</div>
<nav class="container rounded box-shadow" style="background:#87CEFA">
<a href="?page=home"> Home </a> <br>

<?php 
    if( isset($_POST['cat_title'])){
        $cat_title=$_POST['cat_title'];
        echo $cat_title;    
    }
    
?>
<br>
</nav>

<div class="my-3 p-3 bg-white rounded box-shadow"> 
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
            $topic_closed=$topic["topic_closed"];
            
            $nb_posts = countPostsByTopic ($topic_id);
            
                if ($nb_posts >0){
             
            $html_topic .= '<form action="?page=posts&nb_posts=' . $nb_posts .'&topic_closed=' . $topic["topic_closed"] . '&cat_id=' . $cat_id . '&topic_id=' . $topic_id . '" method="POST">';           
                $html_topic .= '<div class="container rounded box-shadow " style="background:#FFEBCD;margin-bottom: 30px">';
                $html_topic .= '<h4>' . $topic["label"] . '</h4>';
                if ($topic["topic_closed"]==1){
                    $html_topic .= '<span class="badge badge-warning">Sujet fermé !</span><br>'; 
                    } 
                $html_topic .= '<a>Nombre de post(s) dans ce sujet:  ' . $nb_posts . '</a>';
                $html_topic .= '<h6>Auteur:  ' . $topic["writer"] . '</h6>';  
                $html_topic .= '<a>Date de création:  ' . $topic["date"] . '</a><br>';             
                $html_topic .= '<input type="hidden" name="topic_id" value=' . $topic["topic_id"] . '>';
                // $html_topic .= '<input type="hidden" name="nb_posts" value=' . $nb_posts . '>';
                $html_topic .= '<input( type="text" name="topic_closed" value=' . $topic["topic_closed"] . '>';
                
                $html_topic .= '<input type="hidden" name="topic_label" value="' . $topic["label"] . '">';
                $html_topic .= '<input type="submit" value="Lire les posts"><br>';
                
                if( isset( $_SESSION["user"] ) ){                                                        
                    if ($_SESSION["user"]["id_role"]==1
                    && $topic_closed==1){  
                $html_topic .= '<br><a href="?service=open_topic&cat_id=' . $cat_id . '&topic_id=' . $topic_id . '" > Ré-ouvrir ce sujet </a>';
                    }
                
                // if( isset( $_SESSION["user"] ) ){                                                        
                    if ($_SESSION["user"]["id_role"]==1
                    && $topic_closed==0){
                    $html_topic .= '<br><a href="?page=confirm_delete_topic&cat_id=' . $cat_id . '&topic_close=' . $topic_closed . '&topic_id=' . $topic_id . '" > Supprimer ce sujet </a>';
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
        $html_new_topic .= '<input class="container btn-lg btn-block" type="submit" value="Créer un sujet">';
        $html_new_topic .= '</form>';

        echo $html_new_topic;
    ?>
   
</div>