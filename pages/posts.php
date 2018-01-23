<div id="posts">
<?php 

    $index_page = 0;
    if( isset( $_GET["index_page"] ) ){
        $index_page = $_GET["index_page"];
    }

?>
<?php 
    $posts = getPosts( $index_page );

    if( count($posts) ){

        $html_post = '<form action="" method="POST">';

            // Génération des posts
            foreach( $posts as $key => $post ) {

                $html_post .= '<div style="border: 1px solid black; margin: 5px;">';
                    // $html_post .= '<input type="checkbox" name="' . $post["label"] . '" value="' . $post["id"] . '">';
                    $html_post .= '<h3>' . $post["title"] . '</h3>';
                    $html_post .= '<h4>' . $post["post_writer"] . '</h4>';
                    $html_post .= '<p>' . $post["post_text"] . ' €</p>';
                $html_post .= '</div>';  

            }

            // $html_post .= '<input type="submit" value="Supprimer">';
        $html_post .= '</form>';

        // Génération de la liste des pages
        $html_post .= '<ul>';

        $nb_pages = ceil( countPosts() / POSTS_BY_PAGE );
        
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
    }
?>
</div>