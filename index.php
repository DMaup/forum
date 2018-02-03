<?php 
    require "functions.php";

    /* Service */
    
    if( isset( $_GET["service"] ) ){

        $service = $_GET["service"];

        switch( $service ){

            case "login": 
                include "services/service_login.php";
                break;
            case "inscription":
                include "services/service_inscription.php";
                break;
            case "create_user":
                include "services/service_create_user.php";
                break;
            case "create_topic":
                connectionRequired( USER, MODERATOR, ADMIN );
                include "services/service_create_topic.php";
                break;
            case "delete_topic":
                connectionRequired( ADMIN );
                include "services/service_delete_topic.php";
                break;
            case "close_topic":
                connectionRequired( ADMIN );
                include "services/service_close_topic.php";
                break;
            case "open_topic":
                connectionRequired( ADMIN );
                include "services/service_open_topic.php";
                break;
            case "create_post":
                connectionRequired( USER, MODERATOR, ADMIN );
                include "services/service_create_post.php";
                break;
            case "delete_post":
                connectionRequired( USER, MODERATOR, ADMIN );
                include "services/service_delete_post.php";
                break;   
            case "edit_post":
                connectionRequired( USER, MODERATOR, ADMIN );
                include "services/service_edit_post.php";
                break;       
            case "disconnect":
                connectionRequired( USER, MODERATOR, ADMIN );
                include "services/service_disconnect.php";
                break;
            default :
                header("Location: ?page=home");
        }
        
        die();
    }

    /* Pages */

    $page = "home";
    $page_file = "";

    if( isset( $_GET["page"] ) ){
        $page = $_GET["page"];
    }

    switch( $page ){

        case "home":            
            $page_file = "pages/home.php";
            break;
        case "inscription":            
            $page_file = "pages/inscription.php";
            break;        
        case "login":
            $page_file = "pages/login.php";
            break;
        case "categories":
            $page_file = "pages/categories.php";
            break;
        case "topics":
            $page_file = "pages/topics.php";
            break;
        case "new_topic":
            connectionRequired(  USER, MODERATOR, ADMIN );
            $page_file = "pages/new_topic.php";
            break;
        case "posts":
            $page_file = "pages/posts.php";
            break;
        case "new_post":
            connectionRequired( USER, MODERATOR, ADMIN );
            $page_file = "pages/new_post.php";
            break;     
        case "edit_post":
            connectionRequired( USER, MODERATOR, ADMIN );
            $page_file = "pages/edit_post.php";
            break;
        case "admin":
            connectionRequired( ADMIN );
            $page_file = "pages/admin.php";
            break;
        case "en_cours":
            connectionRequired( ADMIN );
            $page_file = "pages/en_cours.php";
            break;
        default:
            $page_file = "pages/404.php";
            
    }

    include "commons/header.php";
    include $page_file;
    include "commons/footer.php";

?>