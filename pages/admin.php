<a href="?page=home"> Home </a> <br>
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
    <a href="?page=home"> Créer une catégorie </a> <br><br>
    
    <a href="?page=home"> Clôturer une catégorie </a> <br><br>
    
    <a href="?page=home"> Ré-ouvrir une catégorie </a> <br><br>
    
    <a href="?page=home"> Supprimer une catégorie </a> <br><br>
    
    <a href="?page=home"> Clôturer un sujet </a> <br><br>
    
    <a href="?page=home"> Ré-ouvrir un sujet </a> <br><br>
    
    <a href="?page=home"> Supprimer un sujet </a> <br><br>
    
    <a href="?page=home"> Bloquer un Utilisateur </a> <br><br>
    
    <a href="?page=home"> Supprimer un Utilisateur </a>
    
    

