<link rel="stylesheet" href="assets/css/styles.css">
<h2> Nouveau Post dans la catégorie : </h2>

<?php

if( isset($_GET["message"]) ){
    echo "<div class='message'>" . $_GET["message"] . "</div>";
}

?>

<form action="?service=create_post" method="POST">   

    <label>
        <span> Titre </span><br>
        <input type="textarea" name="post_title" value="<?php $post_title ?>" >
    </label>
        <br>
    <label>
        <span> Texte </span><br>
        <input name="post_text" id="post_text" value="<?php $post_text ?>" >
    </label>
    <br>
        <input type="submit" value="Publier">

</form>



