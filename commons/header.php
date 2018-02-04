<!DOCTYPE html >
<html>
    <head>
        <!-- <meta charset="UTF-8"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="J:\DEV_WEB\UwAmp\www\Forum\assets\css\boostrap.min.css"> -->
        <link rel="stylesheet" href="./assets/css/styles.css">
    </head>
    <body class="bg-light">

        <?php if( isLogged() ) { ?>
            <nav class="container rounded box-shadow" style="background:#87CEFA">
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
                        
                        <?php if( isLogged( ADMIN ) ) { ?>
                    <li> 
                        <a href="?page=admin"> Gestion du Forum </a>
                    </li>

                        <?php } ?>

                </ul>
            </nav>
        <?php } ?>
        </body>
        </html>
