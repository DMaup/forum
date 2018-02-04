<nav class="container rounded box-shadow" style="background:#87CEFA;margin-bottom: 30px">
    <h1>    
          Inscription sur le FORUM "TP PHP" <br>
    </h1>
<a href="?page=home"> Home </a> <br>
</nav>
<div class="container rounded box-shadow " style="background:#FFEBCD;margin-bottom: 30px">
    <h2> Nouvel utilisateur : </h2>

    <?php

    if( isset($_GET["message"]) ){
        echo "<div class='message'>" . $_GET["message"] . "</div>";
    }
    
    ?>
   
    <form action="?service=create_user" method="POST">   

        <label>
            <span> Nom d'utilisateur </span>
            <input type="text" name="new_firstname" value="<?php  $new_firstname ?>" >
        </label>

        <label>
            <span> Mot de passe </span>
            <input type="password" name="new_password" value="<?php  $new_password ?>" >
        </label>

        <label>
            <span> Confirmer le Mot de passe </span>
            <input type="password" name="confirm_password" value="<?php  $confirm_password ?>" >
        </label>
        <br>

        <input class="container btn-lg btn-block" type="submit" value="Valider le formulaire">
        
                    

    </form>
    </div>
    



