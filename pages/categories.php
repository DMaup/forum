<div id="cats">
<?php 

     $index_page = 0;
    if( isset( $_GET["index_page"] ) ){
        $index_page = $_GET["index_page"];
    }

?>
<?php 
    $cats = getCategories();

    if( count($cats) ){

        $html_cat = '<form action="" method="POST">';

            
            foreach( $cats as $key => $cat ) {

                $html_cat .= '<div style="border: 1px solid black; margin: 5px;">';
                    $html_cat .= '<h4>' . $post["writer"] . '</h4>';
                    $html_cat .= '<p>' . $post["text"] . ' €</p>';
                $html_cat .= '</div>';  
            }

        $html_cat .= '</form>';
        
        $html_cat .= '<ul>';
                $html_cat .= '<li>';
                $html_cat .= '<a href="?page=cats&index_page=' . $i .'" >' ;
                $html_cat .= ($i + 1);
                $html_cat .= '</a>';
            $html_cat .= '</li>';

        }

        $html_cat .= '</ul>';

        echo $html_cat;
    }
    else {
        echo "<div> Aucune catégorie trouvée ! </div>";
    }
?>
</div>