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
                    <input type="submit" value="Se Déconnecter">
                    </li>
                    <li>
                        <a href="?page=login"> Changer d'utilisateur </a>
                    </li>
                    <li>
                        <a href="?page=home"> Home </a>
                    </li>
                    <li>
                        <a href="?page=posts"> Poster </a>
                    </li>
                    <li>
                        <a href="?page=edit"> Editer </a>
                    </li>
                    <li>
                        <a href="?page=inscription"> S'inscrire </a>
                    </li>

                    <?php if( isLogged( ADMIN ) ) { ?>

                        <li> 
                            <a href="?page=admin"> Admin </a>
                        </li>

                    <?php } ?>

                </ul>
            </nav>
        <?php } ?>