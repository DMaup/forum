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

    $cats = getCategories($index_page);

    if( count($cats) ){
        $html_cat="";
        foreach( $cats as $key => $cat ) {
            $html_cat .= '<form action="?page=posts" method="POST">';         
            $cat_id=$cat["cat_id"];           
                $html_cat .= '<div type="hidden" style="border: 1px solid black; margin: 5px;">';               
                    $html_cat .= '<h4>' . $cat["cat_title"] . '</h4>';
                    $html_cat .= '<p>' . $cat["cat_description"] . '</p>';
                    $html_cat .= '<input type="">' . $cat["cat_id"] . '</p>';
                    $html_cat .= '<input type="submit" value="Accéder aux sujets">';
                $html_cat .= '</div>';   
           
            $html_cat .= '</form>';
        }
        
        echo $html_cat;
    }
    else {
        echo "<div> Aucune catégorie trouvée ! </div>";
    }
?>

