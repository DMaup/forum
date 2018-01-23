

    <!-- 
       ******  INSCRIPTION DES UTILISATEURS ******
    -->

    <h2> Nouvel utilisateur : </h2>
   
    <form action="?service=create_user" method="POST">   

        <label>
            <span> Prénom </span>
            <input type="text" name="new_firstname" value="<?php  $new_firstname ?>" >
        </label>

        <label>
            <span> Mot de passe </span>
            <input type="password" name="new_password" value="<?php  $new_password ?>" >
        </label>

        <!-- <label>
            <span> Confirmer le Mot de passe </span>
            <input type="password" name="confirm_password" value="<?php  $confirm_password ?>" >
        </label> -->

        <input type="submit" value="Créer">

    </form>



