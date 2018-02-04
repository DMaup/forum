
        <nav class="container rounded box-shadow" style="background:#87CEFA" >
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
        </nav>            
                    </body>
                </html>
                <?php
                }
                ?>    

            <div class="my-3 p-3 bg-white rounded box-shadow"> 

            <?php
                if( isset($_GET["message"]) ){
                    echo "<div class='message'>" . $_GET["message"] . "</div>";
                }
            
                $index_page = 0;
                if( isset( $_GET["index_page"] ) ){
                    $index_page = $_GET["index_page"];
                }

                $cats = getCategories($index_page);

                if( count($cats)){
                    $html_cat="";
                    foreach( $cats as $key => $cat ) {
                        $html_cat .= '<form action="?page=topics&cat_id='.$cat['cat_id'].'" method="POST">';         
                                
                            $html_cat .= '<nav class="container rounded box-shadow " style="background:#FFEBCD;margin-bottom: 30px">';               
                                $html_cat .= '<h4>' . $cat["cat_title"] . '</h4>';
                                $html_cat .= '<p>' . $cat["cat_description"] . '</p>';
                                $html_cat .= '<input type="hidden" name="cat_title" value="' .$cat["cat_title"] . '">';
                                $html_cat .= '<input class="btn btn-secondary btn-lg btn-block" type="submit" value="Entrer">';
                            $html_cat .= '</nav>';   
                    
                        $html_cat .= '</form>';
                    }
                    
                    echo $html_cat;
                }
                
                else {
                    echo "<div> Aucune catégorie trouvée ! </div>";
                }
            ?>
            </div>
        

