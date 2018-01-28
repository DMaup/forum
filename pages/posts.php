<?php

if( isset($_GET["message"]) ){
    echo "<div class='message'>" . $_GET["message"] . "</div>";
}
?>

<a href="?page=home"> Home </a> <br>

<?php 
if( isset($_POST['topic_title'])){
    $topic_title=($_POST['topic_title']);
    echo $topic_title;
}    
if( isset($_POST['topic_id'])){
    $topic_id=($_POST['topic_id']);
    
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
                    // $html_post .= '<input type="checkbox" name="' . $post["label"] . '" value="' . $post["id"] . '">';
                    $html_post .= '<h3>' . $post["title"] . '</h3>';
                    $html_post .= '<h4>' . $post["writer"] . '</h4>';
                    $html_post .= '<p>' . $post["text"] . ' </p>';
                    $html_post .= '<p>' . $post["date"] . ' </p>';
                    $html_post .= '<input type="hidden" name="topic_id" value=' . $post["topic"] . '>';
                    
                        // if ($post["writer"]==$_SESSION["user"]["username"]){
                        //         $html_post .= '<a href="?page=posts"> Supprimer ce post </a>';
                        // }
                       
                    
                $html_post .= '</div>';  

            }
            
            $html_post .= '<input type="hidden" name="topic" value=' . $post["topic"] . '>';
            $html_post .= '<input type="submit" value="Créer un nouveau post">';
        $html_post .= '</form>';

?>
        Nombre de posts dans le sujet : <?php echo sizeof($posts); ?>
        <!-- Génération de la liste des pages -->
<?php      

    $html_post .= '<ul>';
    $index_page = 0;
    if( isset( $_GET["index_page"] ) ){
        $index_page = $_GET["index_page"];
    }
        $nb_pages = ceil( sizeof($posts) / POSTS_BY_PAGE );
        
        
        for( $i=0; $i < $nb_pages; $i++ ){

            $html_post .= '<li>';
                $html_post .= '<a href="?page=posts&index_page=' . $i .'" >' ;
                    $html_post .= ($i + 1);
                $html_post .= '</a>';
            $html_post .= '</li>';

        }

        $html_post .= '</ul>';

        echo $html_post;
    }
    else {
        echo "<div> Aucun post trouvé ! </div>";
        $html_new_post="";    
        $html_new_post .= '<form action="?page=new_post" method="POST">';
        $html_new_post .= '<input type="hidden" name="topic" value=' . $topic_id . '>';
        $html_new_post .= '<input type="submit" value="Créer un post">';
        $html_new_post .= '</form>';
        echo $html_new_post;
    }
?>
</div>