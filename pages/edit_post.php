<a href="?page=home"> Home </a> <br>
<?php 
if( isset($_GET['cat_id'])){
    $cat_id=$_GET['cat_id'];
}

if( isset($_GET['topic_label'])){
    $topic_label=$_GET['topic_label'];
}


if( isset( $_GET["post_id"] ) ){
    
    $id = $_GET["post_id"];
    $topic = $_GET["topic"];
    $topic_label = $_GET["topic_label"];
    
    
    $post = getPostById( $id );
    
    ?> 

    <h2> Edition du post </h2><br>
    <div class="post_text" id="post_text">
        <span><?php echo $post["text"] ?></span><br> 
    </div>
    
    <form action="?service=edit_post&cat_id=<?php echo $cat_id ?>&topic_label=<?php echo $topic_label ?>&topic=<?php echo $topic ?>&post_id=<?php echo $id ?>" method="POST">

            
            <label>
                <br><span> Nouveau texte </span><br>
                <textarea class="post_text" name="text" id="post_text" value="<?php $text ?>" ></textarea>
            </label>
            <br>
            <input type="submit" value="Mettre à jour">

    </form>

    <?php 

}
    else {
        header("Location: ?page=home");
        die();
    }

?>