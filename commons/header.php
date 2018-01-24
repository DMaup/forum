<html>
    <head>
        <meta charset="UTF-8">
        <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
    </head>
    <body>

        <?php if( isLogged() ) { ?>
            <nav>
                <ul>
                    <li>
                        Utilisateur connecté : <?php echo $_SESSION["user"]["username"]; ?>
                    </li>
                    <li>
                        <form method="post" action="?service=disconnect">
                            <input type="submit" value="Se Déconnecter" />
                        </form>
                    </li>
                    <li>
                        <a href="?page=login"> Changer d'utilisateur </a>
                    </li>
                    <li>
                        <a href="?page=home"> Home </a>
                    </li>
                    <?php if( isLogged() ) { ?>
                    <li> 
                        <a href="?page=posts"> Posts </a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="?page=edit"> Editer </a>
                    </li>                 
                    <?php if( isLogged( ADMIN ) ) { ?>
                    <li> 
                        <a href="?page=admin"> Gestion des Utilisateurs </a>
                    </li>

                    <?php } ?>

                </ul>
            </nav>
        <?php } ?>