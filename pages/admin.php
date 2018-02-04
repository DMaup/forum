<a href="?page=home"> Home </a> <br>
<?php 
    $id_role = $_SESSION["user"]["id_role"];

    if( isset($_GET["message"]) ){
        echo "<div class='message'>" . $_GET["message"] . "</div>";
    }

?>
<h1> Administration du forum </h1> 


    
    <a href="?page=en_cours"> Créer une catégorie </a> <br><br>
    
    <a href="?page=en_cours"> Clôturer une catégorie </a> <br><br>
    
    <a href="?page=en_cours"> Ré-ouvrir une catégorie </a> <br><br>
    
    <a href="?page=en_cours"> Supprimer une catégorie </a> <br><br>
    
    <a href="?page=en_cours"> Bloquer un Utilisateur </a> <br><br>
    
    <a href="?page=en_cours"> Supprimer un Utilisateur </a><br><br>

    <a href="?page=en_cours"> Gestion des droits </a> <br>
    
    

