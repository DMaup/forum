<?php
session_start();

define("SALT", "QWONQULqF0");

define("DB_HOST", "localhost");
define("DB_NAME", "forum");
define("DB_USER", "root");
define("DB_PASS", "root");

define("POSTS_BY_PAGE", 6);

// Grants
define("CAN_CREATE_POST", 1);
define("CAN_INTEGER_POST", 2);
define("CAN_EDIT_OWN_POST", 3);
define("CAN_DELETE_OWN_POST", 4);
define("CAN_DELETE_ALL_POSTS", 5);
define("CAN_CANCEL_TOPIC", 6);

// Roles
define("ADMIN", 1);
define("MODERATOR", 2);
define("USER", 3);

//Files

function isLogged( $as_role = USER ){

    return ( 
        isset( $_SESSION["user"] ) 
        && $_SESSION["user"]["id_role"] <= $as_role 
    );

}

function connectionRequired( $as_role = USER ){
    
    if( !isset( $_SESSION["user"] ) ){

        header("Location: ?page=login");
        die();
    }
    else if( !isLogged( $as_role ) ){

        $error = "Vous n'avez les autorisations nécessaires !";
        header("Location: ?page=login&error=".$error);
        die();

    }

}

// $_SESSION["user"] = id / username / password / id_role
function isGranted( $id_role, $id_grant ){

    $connection = getConnection();
    $sql = "SELECT COUNT(*)
    FROM link_role_grant
    WHERE link_role_grant.id_role = ? 
    AND link_role_grant.id_grant = ?";

    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( $statement, "ii", $id_role, $id_grant );
    mysqli_stmt_execute( $statement );
    mysqli_stmt_bind_result( $statement, $result );
    mysqli_stmt_fetch( $statement );

    return (boolean)$result; //cast converting
    
}

function getConnection(){

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if( $errors = mysqli_connect_error($connection) ){
        $errors = utf8_encode($errors);
        header("Location: ?page=login&error=" . $errors); 
        die();
    }

    return $connection;

}

/**** USERS *****/

function getUsers(){

    // starwars
    // football
    // david

    $connection = getConnection();
    $sql = "SELECT username, password FROM users";
    
    $results = mysqli_query($connection, $sql);

    mysqli_close( $connection );
    
    $users = [];
    
    while( $row = mysqli_fetch_assoc($results) ){

        $users[] = $row;
    }  
    return $users;
}

function getUser( $username, $password ){

    $connection = getConnection();

    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( $statement, "ss", $username, $password );
    mysqli_stmt_execute( $statement );
    mysqli_stmt_bind_result($statement, $b_id, $b_username, $b_password, $b_id_role);
    mysqli_stmt_fetch($statement);

    $user = null;
    if( $b_id ){
        $user = [
            "id" => $b_id,
            "username" => $b_username,
            "password" => $b_password,
            "id_role" => $b_id_role
        ];
    }

    mysqli_stmt_close( $statement );
    mysqli_close( $connection );

    return $user;
}

function createUser( $new_user ){
    
    $connection = getConnection();
    $sql = "INSERT INTO users VALUES (null, ?, ?, 3)";

    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( 
        $statement,
        "ss", 
        $new_user["new_firstname"],
        $new_user["new_password"]
         
    );

    mysqli_stmt_execute( $statement );
    $inserted = mysqli_stmt_affected_rows( $statement );

    mysqli_stmt_close( $statement );
    mysqli_close( $connection );

    return (boolean)($inserted > 0);

}
/***** CATEGORY ******/

function getCategories (){

    $connection = getConnection();

    $sql = "SELECT cat_id, cat_title, cat_description FROM categories";
    
    $categories = mysqli_query($connection, $sql);

    mysqli_close( $connection );
    
    $category = [];
    
    while( $row = mysqli_fetch_assoc($categories) ){

        $category[] = $row;

    }
    //debug($category);
    return $category;

}



/***** POSTS ******/

function getPosts( $index_page = 0 ){

    $connection = getConnection();
    $sql = "SELECT post_id, post_title, post_writer, post_text, post_date FROM posts LIMIT ?, ?";

    $start_index = $index_page * POSTS_BY_PAGE;
    $end_index = POSTS_BY_PAGE;

    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( $statement, "ii", $start_index, $end_index);
    mysqli_stmt_execute( $statement );
    mysqli_stmt_bind_result( $statement, $b_id, $b_title, $b_writer, $b_text, $b_date );

    $posts = [];
    while( mysqli_stmt_fetch( $statement ) ) {
        
        $posts[] = [
            "id" => $b_id,
            "title" => utf8_encode( $b_title ),
            "writer" => utf8_encode($b_writer),
            "text" => utf8_encode( $b_text ),
            "date" => $b_date
        ];

    }
    
    mysqli_stmt_close( $statement );
    mysqli_close( $connection );
//debug($posts);
    return $posts;
}

function getPostById( $id ){

    $connection = getConnection();
    $sql = "SELECT * FROM posts WHERE id=?";

    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( $statement, "i", $id );
    mysqli_stmt_execute( $statement );
    mysqli_stmt_bind_result( $statement, $b_id, $b_title, $b_writer, $b_text, $b_date );
    mysqli_stmt_fetch( $statement );

    $post = [
        "id" => $b_id,
        "title" => utf8_encode( $b_title ),
        "writer" => utf8_encode($b_writer),
        "text" => utf8_encode( $b_text ),
        "date" => $b_date
    ];

    mysqli_stmt_close( $statement );
    mysqli_close( $connection );

    return $post;

}

function update_post( $id, $label, $price, $image_url = false ){

    $connection = getConnection();
    $statement;
    
    if( $image_url != false ){

        $sql = "UPDATE products SET label=?, price=?, image_url=? WHERE id=?";
        $statement = mysqli_prepare( $connection, $sql );
        mysqli_stmt_bind_param( $statement, "sdsi", $label, $price, $image_url, $id );

    }
    else {

        $sql = "UPDATE products SET label=?, price=? WHERE id=?";
        $statement = mysqli_prepare( $connection, $sql );
        mysqli_stmt_bind_param( $statement, "sdi", $label, $price, $id );

    }

    mysqli_stmt_execute( $statement );

    // -1 erreur | 0 aucun changement | > 0 nombre de lignes affectées
    $edited = mysqli_stmt_affected_rows( $statement );
    
    mysqli_stmt_close( $statement );
    mysqli_close( $connection );

    return $edited;

}

function deletePostById( $id ){

    $connection = getConnection();
    $sql = "DELETE FROM products WHERE id=?";
    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( $statement, "i", $id );
    mysqli_stmt_execute( $statement );
    
    $deleted = mysqli_stmt_affected_rows( $statement );

    mysqli_stmt_close( $statement );
    mysqli_close( $connection );

    return (boolean)($deleted > 0);

}

function countPosts(){

    $connection = getConnection();
    $sql = "SELECT COUNT(*) as number FROM posts";
    $results = mysqli_query( $connection, $sql );
    $result = mysqli_fetch_assoc( $results );
    mysqli_close( $connection );

    return $result["number"];

}

 
    $post = [
        "title",
        "writer",
        "text",
        
    ];

function createPost( $post ){

    $connection = getConnection();
    $sql = "INSERT INTO post VALUES (null, ?, ?, ?, null)";

    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( 
        $statement, 
        "sss", 
        $post["title"],
        $post["writer"],
        $post["text"] 
    );
    mysqli_stmt_execute( $statement );
    $inserted = mysqli_stmt_affected_rows( $statement );

    mysqli_stmt_close( $statement );
    mysqli_close( $connection );

    return (boolean)($inserted > 0);

}

function debug( $arg, $printr = false ){
    
    if( $printr ){
        echo "<pre>";
        print_r($arg);
        echo "</pre>";
    }
    else {
        var_dump( $arg );
    }
    
    die();

}

