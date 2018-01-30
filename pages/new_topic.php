<link rel="stylesheet" href="assets/css/styles.css">
<a href="?page=home"> Home </a> <br>
<h2> Nouveau Sujet dans la catégorie: </h2>

<?php

if( isset($_GET["message"]) ){
    echo "<div class='message'>" . $_GET["message"] . "</div>";
}

if( isset($_POST['cat_id']) ){
    $cat_id=$_POST['cat_id'];
    
}

if( isset($_GET['topic_id'])){
    $topic_id=$_GET['topic_id'];
}

if( isset($_GET['cat_id'])){
    $cat_id=$_GET['cat_id'];
}

?>

<form action="?service=create_topic" method="POST">  


    <label>
        <span> Titre </span><br>
        <input type="text" name="new_topic_label" size="80px" value="<?php $new_topic_label ?>" >
    </label>

        <input type="hidden" name="cat_id" value=<?php echo ($cat_id) ?> >
        <!-- <input type="text" name="topic_id" value="<?php echo $topic_id; ?>" > -->
   
        <input type="submit" value="Saisir le premier post associé">

</form>
<?php

?>



