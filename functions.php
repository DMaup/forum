<?php
session_start();

define("SALT", "QWONQULqF0");

define("DB_HOST", "localhost");
define("DB_NAME", "forum");
define("DB_USER", "root");
define("DB_PASS", "root");

define("POSTS_BY_PAGE", 4);

// Grants
define("CAN_CREATE_TOPIC", 1);
define("CAN_DELETE_TOPIC", 2);
define("CAN_CREATE_POST", 3);
define("CAN_EDIT_OWN_POST", 4);
define("CAN_DELETE_OWN_POST", 5);
define("CAN_DELETE_ALL_POSTS", 6);

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
    
    return $category;
}

/***** TOPICS ******/

function getTopicsByCat($b_cat){

    $connection = getConnection();
    
    $sql = "SELECT topics.topic_id, topics.topic_label, topics.topic_date, categories.cat_title, users.username
    FROM topics
    INNER JOIN users ON users.user_id = topics.topic_writer
    INNER JOIN categories ON categories.cat_id = topics.topic_cat
    WHERE categories.cat_id=?";
            

    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( $statement, "i", $b_cat );
    mysqli_stmt_execute( $statement );
    mysqli_stmt_bind_result( $statement, $b_id, $b_label, $b_date, $b_cat, $b_writer);
    $topics = [];
    while( mysqli_stmt_fetch( $statement ) ) {

    $topics[] = [
        "topic_id" => $b_id,
        "label" => $b_label,
        "date" => $b_date,
        "cat" => $b_cat,
        "writer" => $b_writer         
    ];
    
    }
    
    mysqli_stmt_close( $statement );
    mysqli_close( $connection );

    return $topics;
}

function countTopicsByCat($b_cat){

    $connection = getConnection();
    $sql = "SELECT COUNT(*) as nb_topicsByCat FROM topics WHERE topic_cat=?";
    $results = mysqli_query( $connection, "i", $sql );
    $result = mysqli_fetch_assoc( $results );
    mysqli_close( $connection );

    return $result["nb_topicsByCat"];
}

function createTopic( $new_topic ){
    $connection = getConnection();
    $current_user = $_SESSION["user"]["id"];
    $cat_id = $_SESSION["newtopic"]["cat_id"];
        
    $sql = "INSERT INTO topics VALUES (null, ?, null, ?, ?)";

    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( 
        $statement, 
        "ssi", 
        $new_topic["new_topic_label"],
        $cat_id,
        $current_user
    );

    mysqli_stmt_execute( $statement );
    $topic_inserted = mysqli_stmt_affected_rows( $statement );
    $topic_id = mysqli_insert_id($connection);

    mysqli_stmt_close( $statement );
    mysqli_close( $connection );
    
    return ($topic_id);
}

function getTopicLabel($topic_id){

    $connection = getConnection();
    
    $sql = "SELECT topics.topic_label
    FROM topics WHERE topics.topic_id=?";
    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( $statement, "i", $topic_id );
    mysqli_stmt_execute( $statement );
    mysqli_stmt_bind_result( $statement, $topic_label);
    mysqli_stmt_fetch( $statement );

     mysqli_stmt_close( $statement );
    mysqli_close( $connection );

    return $topic_label;
}

/***** POSTS ******/

function countPostsByTopic( $topic_id ){

    $connection = getConnection();
    $sql = "SELECT COUNT(*) as nb_postsByTopic FROM posts WHERE post_topic=?";
    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( $statement, "i", $topic_id );
    mysqli_stmt_execute( $statement );
    mysqli_stmt_bind_result( $statement, $nb_posts );
    mysqli_stmt_fetch( $statement );

    $nb_result = $nb_posts;

    return $nb_result;
}

function getPostById( $id ){

    $connection = getConnection();
    $sql = "SELECT post_text FROM posts WHERE post_id=?";

    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( $statement, "i", $id );
    mysqli_stmt_execute( $statement );
    mysqli_stmt_bind_result( $statement, $b_text );
    mysqli_stmt_fetch( $statement );

    $post = [
        "id" => $id,
        "text" => $b_text      
    ];

    mysqli_stmt_close( $statement );
    mysqli_close( $connection );

    return $post;
}

function getPostByTopic($b_topic, $index_page = 0){
    $connection = getConnection();
    $sql = "SELECT post_id, post_title, post_writer, post_text, post_topic, post_date
    FROM posts
    WHERE post_topic=?
    LIMIT ?, ?";

    $start_index = $index_page * POSTS_BY_PAGE;
    $end_index = POSTS_BY_PAGE;

    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( $statement, "iii", $b_topic, $start_index, $end_index);
    mysqli_stmt_execute( $statement );
    mysqli_stmt_bind_result( $statement, $b_id, $b_title, $b_writer, $b_text, $b_topic, $b_date );
    $posts = [];
    while( mysqli_stmt_fetch( $statement ) ) {

    $posts[] = [
        "id" => $b_id,
        "title" => $b_title,
        "writer" => $b_writer,
        "text" => $b_text,
        "topic" => $b_topic,
        "date" => $b_date
    ];
    }

    mysqli_stmt_close( $statement );
    mysqli_close( $connection );

    return $posts;
}

function update_post( $text, $id){

    $connection = getConnection();
    $statement;
    
    $sql = "UPDATE posts SET post_text=? WHERE post_id=?";
    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( $statement, "si", $text, $id);
    mysqli_stmt_execute( $statement );
   

    // -1 erreur | 0 aucun changement | > 0 nombre de lignes affectées
    $edited = mysqli_stmt_affected_rows( $statement );
    
    mysqli_stmt_close( $statement );
    mysqli_close( $connection );
    
    return $edited;
}

function deletePostById( $id ){

    $connection = getConnection();
    $sql = "DELETE FROM posts WHERE post_id=?";
    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( $statement, "i", $id );
    mysqli_stmt_execute( $statement );
    
    $deleted = mysqli_stmt_affected_rows( $statement );

    mysqli_stmt_close( $statement );
    mysqli_close( $connection );

    return (boolean)($deleted > 0);
}

function createPost( $new_post ){
    $connection = getConnection();
    $current_user = $_SESSION["user"]["username"];
    
    $sql = "INSERT INTO posts VALUES (null, ?, ?, null, ?, ?)";

    $statement = mysqli_prepare( $connection, $sql );
    mysqli_stmt_bind_param( 
        $statement, 
        "isss",
        $new_post["post_topic"],
        $new_post["post_title"],
        $current_user,
        $new_post["post_text"]
    );

    mysqli_stmt_execute( $statement );
    $post_inserted = mysqli_stmt_affected_rows( $statement );

    mysqli_stmt_close( $statement );
    mysqli_close( $connection );
    
    return (boolean)($post_inserted > 0);
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

