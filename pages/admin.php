<a href="?page=en_cours"> en_cours </a> <br>
<?php 
    $id_role = $_SESSION["user"]["id_role"];

    if( isset($_GET["message"]) ){
        echo "<div class='message'>" . $_GET["message"] . "</div>";
    }

?>
<h1> Administration du forum </h1> 


    <!-- 
       ****** GESTION CREATION DES CATEGORIES ******
    -->
    <a href="?page=en_cours"> Créer une catégorie </a> <br><br>
    
    <a href="?page=en_cours"> Clôturer une catégorie </a> <br><br>
    
    <a href="?page=en_cours"> Ré-ouvrir une catégorie </a> <br><br>
    
    <a href="?page=en_cours"> Supprimer une catégorie </a> <br><br>
    
    <a href="?page=en_cours"> Clôturer un sujet </a> <br><br>
    
    <a href="?page=en_cours"> Ré-ouvrir un sujet </a> <br><br>
    
    <a href="?page=en_cours"> Supprimer un sujet </a> <br><br>
    
    <a href="?page=en_cours"> Bloquer un Utilisateur </a> <br><br>
    
    <a href="?page=en_cours"> Supprimer un Utilisateur </a>
    
    

