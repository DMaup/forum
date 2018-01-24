<?php 
    require "functions.php";

    /* Service */
    // mon/url.php?service=nom_du_service

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
            case "choose_cat":
                include "pages/categories.php";
                break;
            case "post":
                connectionRequired( USER, MODERATOR, ADMIN );
                include "pages/posts.php";
                break;
            case "edit_post":
                connectionRequired( USER, MODERATOR, ADMIN );
                include "services/service_edit_post.php";
                break;
            case "create_post":
                connectionRequired( USER, MODERATOR, ADMIN );
                include "services/service_create_post.php";
                break;
            case "delete_own_post":
                connectionRequired( USER, MODERATOR, ADMIN );
                include "services/service_delete_own_post.php";
                break;
            case "delete_all_post":
                connectionRequired( MODERATOR, ADMIN );
                include "services/service_delete_all_posts.php";
                break;
            case "create_topic":
                connectionRequired( ADMIN );
                include "services/service_create_topic.php";
                break;
            case "delete_topic":
                connectionRequired( ADMIN );
                include "services/service_delete_topic.php";
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
        
        case "login":
            $page_file = "pages/login.php";
            break;

        case "posts":
            connectionRequired();
            $page_file = "pages/posts.php";
            break;

        case "edit":
            connectionRequired( USER, MODERATOR, ADMIN );
            $page_file = "pages/edit.php";
            break;

        case "admin":
            connectionRequired( ADMIN );
            $page_file = "pages/admin.php";
            break;

        case "inscription":
            
            $page_file = "pages/inscription.php";
            break;

        default:
            $page_file = "pages/404.php";

    }

    include "commons/header.php";
    include $page_file;
    include "commons/footer.php";

?>