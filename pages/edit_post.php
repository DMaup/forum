<?php 

if( isset( $_GET["post_id"] ) ){
    
    $id = $_GET["post_id"];
    
    $post = getPostById( $id );
    
    ?> 

    <h2> Edition du post <?php echo $post["text"] ?> </h2>
    
    <form action="?service=edit_post&post_id=<?php echo $id ?>" method="POST">

            
            <label>
                <span> Texte à éditer </span><br>
                <textarea name="text" id="text" value="<?php $text ?>" ></textarea>
            </label>

            <input type="submit" value="Editer">

    </form>

    <?php 

}
    else {
        header("Location: ?page=home");
        die();
    }

?>