<?php
$index_page = 0;
if( isset( $_GET["index_page"] ) ){
    $index_page = $_GET["index_page"];
    $topic_id = $_GET["id"];
    
}

if( isset($_GET["message"]) ){
    echo "<div class='message'>" . $_GET["message"] . "</div>";
}
?>

<a href="?page=home"> Home </a> <br>

<?php 
    
if( isset($_POST['topic_id'])){
    $topic_id=($_POST['topic_id']);
    $topic_label=getTopicLabel($topic_id);
}


?>
<br>
<div id="posts">

<?php


    $posts = getPostByTopic($topic_id);

    if( count($posts) ){
        
            
        $html_post = '<form action="?page=new_post" method="POST">';

            // Génération des posts
            foreach( $posts as $key => $post ) {

                $html_post .= '<div style="border: 1px solid black; margin: 5px;">';
                    $html_post .= '<h4>' . $post["writer"] . '</h4>';
                    $html_post .= '<p>' . $post["text"] . ' </p>';
                    $html_post .= '<p>' . $post["date"] . ' </p>';
                    $html_post .= '<input type="hidden" name="post_id" value=' . $post["id"] . '>';
                    $html_post .= '<input type="hidden" name="topic_id" value=' . $post["topic"] . '>';                    
                        if( isset( $_SESSION["user"] ) ){                                                        
                            if ($post["writer"]==$_SESSION["user"]["username"]
                            || $_SESSION["user"]["id_role"]==1
                            || $_SESSION["user"]["id_role"]==2){
                            $html_post .= '<a href="?service=delete_post&id='.$post["id"].'" > Supprimer ce post </a>';
                            }
                        }
                        else{    
                        }
                        if( isset( $_SESSION["user"] ) ){                                                        
                            if ($post["writer"]==$_SESSION["user"]["username"]){
                            $html_post .= '<br><a href="?page=edit_post&post_id=' .$post["id"].'" > Modifier ce post </a>';

                            }
                        }
                        else{    
                        }                                        
                $html_post .= '</div>';  

            }
            
            $html_post .= '<input type="hidden" name="topic" value=' . $post["topic"] . '>';
            $html_post .= '<input type="submit" value="Créer un nouveau post">';
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
    // else {
    //     echo "<div> Aucun post trouvé ! </div>";
    // }
?>
</div>