<nav class="container rounded box-shadow" style="background:#87CEFA;margin-bottom: 30px">
    <h1>    
         FORUM "TP PHP" <br>
    </h1>
<a href="?page=home"> Home </a> <br>
</nav>
<div class="container rounded box-shadow " style="background:#FFEBCD;margin-bottom: 30px">
<h1> Login </h1>

<?php

    if( isset($_GET["error"]) ){
        echo "<div class='error'>" . $_GET["error"] . "</div>";
    }
    
?>

<form action="?service=login" method="POST">

    <label>Username :</label>
    <input type="text" name="username"> <br>

    <label>Password : </label>
    <input type="password" name="password"> <br>

    <input class="container btn-lg btn-block" type="submit" value="Connexion">

</form>
</div>