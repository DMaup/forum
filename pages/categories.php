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
                    $html_cat .= '<h4>' . $cat["cat_title"] . '</h4>';
                    $html_cat .= '<p>' . $cat["cat_description"] . ' </p>';
                    $html_cat .= '<p>' . $cat["cat_id"] . '</p>';
                $html_cat .= '</div>';  
            }

        $html_cat .= '</form>';
        
        echo $html_cat;
    }

    else {
        echo "<div> Aucune catégorie trouvée ! </div>";
    }
?>
</div>