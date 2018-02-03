<?php
$index_page = 0;
if( isset( $_GET["index_page"] ) ){
    $index_page = $_GET["index_page"];
    $topic_id = $_GET["id"];   
}

if( isset($_GET["message"]) ){
    echo "<div class='message'>" . $_GET["message"] . "</div>";
}

if( isset($_GET['cat_id'])){
    $cat_id=$_GET['cat_id'];
}

if( isset($_GET['topic_id'])){
    $topic_id=$_GET['topic_id'];
}
$topic_closed=0;
if( isset($_GET['topic_closed'])){
    $topic_closed=($_GET['topic_closed']);
}
// $topic_closed=1;
// if( isset($_GET['topic_closed'])){
//     $topic_closed=$_GET['topic_closed'];
// }

?>

<a href="?page=home"> Home </a> <br>
<a href="?page=topics&cat_id=<?php echo $cat_id ?>&topic=<?php echo $topic_id ?>"> Retour à la liste des sujets </a> <br>

<?php 
   
    $topic_label=getTopicLabel($topic_id);

?>
<br>
<div id="posts">

<?php

    $posts = getPostByTopic($topic_id, $index_page);

    if( count($posts) ){
               
        $html_post = '<form action="?page=new_post&cat_id=' . $cat_id . '" method="POST">';

            // Génération des posts
            foreach( $posts as $key => $post ) {

                $html_post .= '<div style="border: 1px solid black; margin: 5px;">';
                    $html_post .= '<h4>' . $post["writer"] . '</h4>';
                    $html_post .= '<p>' . $post["text"] . ' </p>';
                    $html_post .= '<p>' . $post["date"] . ' </p>';
                    $html_post .= '<input type="hidden" name="post_id" value=' . $post["id"] . '>';
                    $html_post .= '<input type="hidden" name="topic_closed" value=' . $topic_closed . '>';
                    $html_post .= '<input type="hidden" name="topic_id" value=' . $post["topic"] . '>';                    
                        if( isset( $_SESSION["user"] ) ){                                                        
                            if ((($post["writer"]==$_SESSION["user"]["username"]
                            || $_SESSION["user"]["id_role"]==1
                            || $_SESSION["user"]["id_role"]==2))
                            && $topic_closed==0){
                            $html_post .= '<a href="?service=delete_post&cat_id=' . $cat_id . '&topic_id=' . $post["topic"] . '&id=' . $post["id"] . '" > Supprimer ce post </a>';
                            }
                        }

                        else{    
                        }

                        if( isset( $_SESSION["user"] ) ){                                                        
                            if ($post["writer"]==$_SESSION["user"]["username"]
                            && $topic_closed==0){
                            $html_post .= '<br><a href="?page=edit_post&cat_id=' . $cat_id . '&topic=' . $post["topic"] . '&topic_label=' . $topic_label . '&post_id=' . $post["id"] . '" > Modifier ce post </a>';
                            }

                        }

                        else{    
                        }  
                                                              
                $html_post .= '</div>';  
            }
            if ($topic_closed==0){
            $html_post .= '<input type="hidden" name="topic" value=' . $post["topic"] . '>';
            $html_post .= '<input type="submit" value="Créer un nouveau post">';
            }
        $html_post .= '</form>';

        //<!-- Génération de la liste des pages -->
      
        $html_post .= '<ul>';       
        $nb_posts = countPostsByTopic( $topic_id );    
        $nb_pages = ceil( $nb_posts / POSTS_BY_PAGE );
       
        for( $i=0; $i < $nb_pages; $i++ ){ 

            $html_post .= '<li>';
                $html_post .= '<a href="?page=posts&id=' .$topic_id . '&index_page=' . $i .'" >' ;
                    $html_post .= ($i + 1);
                $html_post .= '</a>';
            $html_post .= '</li>';
        }

        $html_post .= '</ul>';

        echo $html_post;
    }
?>
</div>