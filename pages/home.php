<h1>    
    Bienvenue sur le FORUM "TP PHP" <br>
</h1>
<?php 
    if( !isLogged() ) { ?>
        <h4>
            <li>
                <a href="?page=inscription"> S'inscrire </a>
            </li>
            <li>
                <a href="?page=login"> S'identifier </a>
            </li>
        </h4><br>
    <?php
    }
    ?>
    
    

<div id="home">


<?php 

    $index_page = 0;
    if( isset( $_GET["index_page"] ) ){
        $index_page = $_GET["index_page"];
    }

?>

<nav>
        <ul>
            <li>
                <form method="post" action="">
                    <input type="submit" value="Se Déconnecter" />
                </form>
            </li>
            <li>
                <a href="?page=home"> Changer d'utilisateur </a>
            </li>
        </ul>
    </nav>

    <?php 
    $cats = getCategories();

    if( count($cats) ){

        $html_cat = '<form action="" method="POST">';

            
            foreach( $cats as $key => $cat ) {                
                    $html_cat .= '<h4>' . $cat["cat_title"] . '</h4>';
                    $html_cat .= '<p>' . $cat["description"] . '</p>';
                 
            }

        $html_cat .= '</form>';
        
        $html_cat .= '<ul>';
                $html_cat .= '<li>';
                $html_cat .= '<a href="?page=cats&index_page=' . $i .'" >' ;
                $html_cat .= ($i + 1);
                $html_cat .= '</a>';
            $html_cat .= '</li>';

        

        $html_cat .= '</ul>';

        echo $html_cat;
    }
    else {
        echo "<div> Aucune catégorie trouvée ! </div>";
    }
?>

<?php 
    $posts = getPosts( $index_page );

    if( count($posts) ){

        $html_post = '<form action="?service=create_post" method="POST">';

            // Génération des posts
            foreach( $posts as $key => $post ) {

                $html_post .= '<div style="border: 1px solid black; margin: 5px;">';
                    $html_post .= '<h3>' . $post["title"] . '</h3>';
                    $html_post .= '<h4>' . $post["writer"] . '</h4>';
                    $html_post .= '<p>' . $post["text"] . ' </p>';
                    $html_post .= '<p>' . $post["date"] . ' </p>';
                $html_post .= '</div>';  

            }

            
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
