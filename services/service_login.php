<?php
$connected = false;

if( isset( $_POST["username"] ) && isset( $_POST["password"] ) ){

    $username = $_POST["username"];
    $password = sha1( $_POST["password"] . SALT );

    $user = getUser( $username, $password );
    if( $user ){

        $_SESSION["user"] = $user;
        $connected = true;
    }
}

if( $connected ){
    header("Location: ?page=home");
}

else {
    
    SESSION_destroy(); 
    
    $error = urlencode("Identifiant ou mot de passe incorrect");
    header("Location: ?page=login&error=".$error);
}
?>