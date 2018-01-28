<link rel="stylesheet" href="assets/css/styles.css">
<a href="?page=home"> Home </a> <br>
<h2> Nouveau Post sur le sujet : </h2>

<?php

if( isset($_GET["message"]) ){
    echo "<div class='message'>" . $_GET["message"] . "</div>";
}

if( isset($_POST['topic'])){
    $topic_id=($_POST['topic']);

}

?>

<form action="?service=create_post" method="POST">   

    <label>
        <span> Titre </span><br>
        <input type="text" name="post_title" value="<?php $post_title ?>" >
    </label>
        <br>
    <label>
        <span> Texte </span><br>
        <textarea name="post_text" id="post_text" value="<?php $post_text ?>" ></textarea>
    </label>
    <br>
        <input type="hidden" name="post_topic" value="<?php echo $topic_id ?>" >
        <input type="submit" value="Publier">

</form>



