<?php 

if( isset( $_GET["post_id"] ) ){
    
    $id = $_GET["post_id"];
    $product = getPostById( $id );
    ?> 

    <h2> Edition du post <?php echo $post["title"] ?> </h2>
    
    <form action="?service=edit_post&id=<?php echo $id ?>" method="POST" enctype="multipart/form-data" >

            <label>
                <span> Titre </span><br>
                <input type="text" name="post_title" value="<?php $post_title ?>" >
            </label>

            <label>
                <span> Texte </span><br>
                <textarea name="post_text" id="post_text" value="<?php $post_text ?>" ></textarea>
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