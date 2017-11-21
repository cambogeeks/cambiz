<?php    
    date_default_timezone_set('Asia/Bangkok');
    include 'admin/class.user.php';
    $views = new USER();
    // page title and social config
    if(isset($_REQUEST['id_article'])){
        define("PAGE", 2);   
    }else{
        define("PAGE", 1);
    }
    include "views/define.php";
    include "views/header.php";

    switch (@$_REQUEST['views']) {

        case 'detail_new':
            case 'detail_news':
            include "views/detail_news.php";
            break;
         case 'subpage':
            include "views/sub_page.php";
            break;
            
        case 'story':
            include "views/pptime_story.php";
            break;

        default:
            include "views/home.php";
            break;
    }
 
    include "views/footer.php";

?>