<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo PAGE_TITLE; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <meta name="description" content="<?php echo PAGE_DESC; ?>">
        <meta name="keyword" content="<?php echo PAGE_KEY; ?>">

        
         <!-- You can use Open Graph tags to customize link previews.
        Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
        <meta property="og:url"           content="<?php echo PAGE_URL; ?>" />
        <meta property="og:type"          content="http://www.keiladaily/" />
        <meta property="og:title"         content="<?php echo PAGE_TITLE; ?>" />
        <meta property="og:description"   content="<?php echo PAGE_DESC; ?>" />
        <meta property="og:image"         content="<?php echo PAGE_IMG; ?>" />

        <!-- Font family -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700,700italic,500italic,400italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Nokora:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Koulen' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Hanuman:400,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/biz_thems_style.css">
        <link rel="stylesheet" href="plugins/responsive_menu/css/style.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>       

        <!-- overflow dotted -->
         <script src="js/vendor/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" language="javascript" src="plugins/dot/jquery.dotdotdot.js"></script>
        <script type="text/javascript" language="javascript">
       $(function() {
                $('.dot1').dotdotdot();
            });
        </script>
        <!-- fav icon -->
        <link rel="apple-touch-icon" sizes="57x57" href="img/icon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="img/icon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/icon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="img/icon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/icon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="img/icon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="img/icon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="img/icon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="img/icon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/icon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="img/icon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/icon/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="img/icon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <?php $c_date = date("Y-m-d h:i:s");?>

    </head>
    <body class="responsive_test">

       <!--fb-->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script> 
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <div  id="top-header"> 
             <div class="logo-ads-section">
                <div class="container">
                    <div class="col-md-4">
                        <div class="logo-pptime">
                        <a href="index.php"><img src="img/biz_logo.png" alt="Dr Business Cambodia"></a>
                     </div> 
                    </div>
                    <div class="col-md-8 r-hiden">    
                       
                         <div class="row"> 
                            <div class="col-md-12">
                                
                                <div class="supper-leader-ads">

                                    <!-- start flexslider -->
                                    <div class="flexslider">
                                        <ul class="slides">
                                            <?php 
                                                 $items= array('<a href="#"  target="_blank"><img src="img/ads/biz-banner_ads.png"></a>');
                                                foreach ($items as $value) {                                            
                                            ?>
                                            <li>
                                                
                                                <?php echo $value; ?> 
                                                
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <!-- end flexslider -->
                                 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>

        <nav id="navigation">
            <div class="navbar navbar-default navbar-static-top" role="navigation">
                <div class="container">
                    <!-- resposive menu bar -->
                    <div class="responsive-menu-bar">        
                        <header>
                            <div id="logo"><a href="index.php"><img src="img/kd-logo-r.png" alt="Homepage"></a></div>
                            <div id="cd-hamburger-menu"><a class="cd-img-replace" href="#0"><i class="fa fa-bars" aria-hidden="true"></i></a></div>
                            <div id="cd-cart-trigger"><a class="cd-img-replace" href="#0">Cart</a></div>
                        </header>

                        <nav id="main-nav">
                            <ul>
                                 <li><a href="index.php">ទំព័រដើម</a></li>
                            <?php 
                                $arraystyle = array('news','biz', 'life_style','tech', 'sport', 'art', 'photo');
                                $stmt_menu_r = $views->runQuery("SELECT c_id, c_title FROM menu WHERE c_type = :menu_type and delete_statue = :d_s ORDER BY ordering");
                                $stmt_menu_r -> execute(array(':menu_type' => 2, ':d_s'=> 0));
                                $arraystyle = array('news','biz', 'life_style','tech', 'sport', 'art', 'photo');
                                $i = 0;
                                while($rs_menu_r = $stmt_menu_r -> fetch(PDO::FETCH_ASSOC)){
                           ?>
                                     <li class="<?php echo $arraystyle[$i];?>"><a href="index.php?views=subpage&page_id=<?php echo $rs_menu_r['c_id'];?>"><?php echo $rs_menu_r['c_title'];?></a></li>

                            <?php $i++; } ?>
                            </ul>
                        </nav>
                        <div id="cd-cart">
                    
                          
                            <ul class="cd-cart-items">
                                <li>
                                    <a href="#">  Tel: 016 757 168 / 011 977 123 </a>
                                </li> 
                            </ul>    <!--  cd-cart-items -->
                          
                           
                        </div> <!-- cd-cart -->
                    </div><!--end resposive menu -->

                    <div class="navbar-collapse collapse">
                        <div class="navbar-header">
                            <a href="index.php">
                                <img id="image_logo_small" class="hidden" src="img/menu-logo-scroll.png" alt="Second Images"/>
                                <i id="image_logo" class="fa fa-home" aria-hidden="true"></i>
                            </a>
                        </div>
                        <ul class="navbar-nav navbar-left">
                          <?php 
                                
                                $stmt_menu = $views->runQuery("SELECT c_id, c_title FROM menu WHERE c_type = :menu_type and delete_statue = :d_s ORDER BY ordering");
                                $stmt_menu -> execute(array(':menu_type' => 2, ':d_s' => 0));
                               
                                $i = 0;
                                while($rs_menu = $stmt_menu -> fetch(PDO::FETCH_ASSOC)){
                           ?>
                                <li><a href="index.php?views=subpage&page_id=<?php echo $rs_menu['c_id'];?>"><?php echo $rs_menu['c_title'];?></a></li>
                           
                           <?php $i++; } ?>
            
                        </ul>

                    </div><!--/.nav-collapse -->
                </div><!--/.container -->
            </div><!--navbar-default-->
        </nav><!--navigation section end here-->
        <!--
        <div class="leading_location_ads mobile_ads_leading">
            <div class="container">             
                    <div class="row"> 
                        
                             <div class="supper-leader-ads">

                                    <!-- start flexslider 
                                    <div class="flexslider">
                                        <ul class="slides">
                                            <?php 
                                              $items= array('<a href="https://www.facebook.com/onlinesportstv.asia"  target="_blank"><img src="img/ads/kd-onlinetv.png"></a>');
                                             foreach ($items as $value) {                                             
                                            ?>
                                            <li>
                                                
                                                <?php echo $value; ?> 
                                                
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    end flexslider           
                            </div>
                    </div>               
            </div>
        </div>
        -->

