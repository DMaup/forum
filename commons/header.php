<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="assets/css/boostrap.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>

        <?php if( isLogged() ) { ?>
            <nav>
                <ul>
                    <li>
                        Utilisateur connecté : <?php echo $_SESSION["user"]["username"]?>
                                                
                        <?php
                        if ($_SESSION["user"]["id_role"]==1){
                                $role_name="Administrateur";
                        }
                        else if ($_SESSION["user"]["id_role"]==2){
                            $role_name="Modérateur";
                        }
                        else if ($_SESSION["user"]["id_role"]==3){
                            $role_name="Utilisateur standard";
                        }
                        
                        ?>
                        (<?php echo $role_name;?>)
                    </li>
                    <li>
                        <form method="post" action="?service=disconnect">
                            <input type="submit" value="Se Déconnecter" />
                        </form>
                    </li>
                    <li>
                        <a href="?page=login"> Changer d'utilisateur </a>
                    </li>
                        <?php if( !isLogged() ) { ?>
                    <li>                    
                        <a href="?page=home"> Home </a>
                    </li>
                        <?php } ?>
                        <?php if( isLogged() ) { ?>
                    <!-- <li> 
                        <a href="?page=posts"> Posts </a>
                    </li> -->
                        <!-- <?php } ?>
                        <?php if( isLogged() ) { ?>
                    <li> 
                        <a href="?page=categories"> Catégories </a>
                    </li>
                        <?php } ?>
                        <?php if( isLogged() ) { ?>
                    <li> 
                        <a href="?page=topics"> Sujets </a>
                    </li>
                        <?php } ?>
                    <li>
                        <a href="?page=edit"> Editer </a>
                    </li>                  -->
                        <?php if( isLogged( ADMIN ) ) { ?>
                    <li> 
                        <a href="?page=admin"> Gestion du Forum </a>
                    </li>

                        <?php } ?>

                </ul>
            </nav>
        <?php } ?>